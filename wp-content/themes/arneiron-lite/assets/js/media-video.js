/**
 * Video in a post plays while it is on screen and stops when it is not.
 *
 * Three players, one observer:
 *   - <video data-arneiron-autoplay>        core/video, and a featured image
 *                                           that is really a video
 *   - <iframe data-arneiron-autoplay>       a YouTube embed, driven over
 *                                           postMessage (inc/media-video.php
 *                                           put enablejsapi=1 in its src)
 *
 * Rules kept deliberately:
 *   - muted, always. An unmuted autoplay is blocked by every browser and is
 *     rude in the ones that allow it.
 *   - `prefers-reduced-motion: reduce` means nothing autoplays. The controls
 *     stay, so the reader can still play it; that is the whole accommodation.
 *   - leaving the view PAUSES, it does not reset. Coming back resumes.
 *   - a video the reader paused by hand is not started again. We only drive
 *     players we started.
 *   - a hidden tab pauses everything.
 *
 * Kill switch: ?arneiron_video=0 stops the script being enqueued at all
 * (inc/media-video.php), so there is nothing to undo in the markup.
 *
 * @package ArneIron
 */
( function () {
	'use strict';

	var STRINGS = window.arneironMediaVideo || {};
	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/* Players this script started, so a hand-paused one is left alone. */
	var ours = 'undefined' !== typeof WeakSet ? new WeakSet() : null;

	function ytCommand( frame, func ) {
		if ( ! frame.contentWindow ) {
			return;
		}
		try {
			frame.contentWindow.postMessage(
				JSON.stringify( { event: 'command', func: func, args: [] } ),
				'*'
			);
		} catch ( e ) {
			/* A cross-origin frame that is not ready yet. Nothing to do. */
		}
	}

	function play( el ) {
		if ( reduce ) {
			return;
		}
		if ( 'IFRAME' === el.tagName ) {
			ytCommand( el, 'playVideo' );
			if ( ours ) {
				ours.add( el );
			}
			return;
		}
		el.muted = true;
		var p = el.play();
		if ( p && p.catch ) {
			p.catch( function () {
				/* Blocked (no gesture, or a codec the browser will not start).
				   The element keeps its own controls, so the reader can play
				   it; we do not retry and we do not report. */
			} );
		}
		if ( ours ) {
			ours.add( el );
		}
	}

	function pause( el ) {
		if ( ours && ! ours.has( el ) ) {
			return;
		}
		if ( 'IFRAME' === el.tagName ) {
			ytCommand( el, 'pauseVideo' );
			return;
		}
		if ( ! el.paused ) {
			el.pause();
		}
	}

	/* ONE player at a time.
	   A post can have two clips side by side — measured on the 2026-10-23 post,
	   where scrolling past put two of its three videos over the threshold
	   together and both looped at once. Two competing loops is not "it plays
	   when it appears", it is noise. So the observer keeps a live map of how
	   much of each player is on screen and runs only the most visible one,
	   pausing every other player it started. */
	var ratios = null;
	var current = null;

	function arbitrate() {
		var best = null;
		var bestRatio = 0.35; /* also the floor: below this, nothing plays */
		ratios.forEach( function ( ratio, el ) {
			/* A clip the Scroll Story panel has taken over is visually
			   hidden (1px, clipped) but still "on screen" to the observer.
			   It must not win the slot: the panel plays its own copy. */
			if ( el.closest && el.closest( '.scroll-story__src' ) ) {
				if ( el === current ) {
					pause( el );
					current = null;
				}
				return;
			}
			if ( ratio > bestRatio ) {
				bestRatio = ratio;
				best = el;
			}
		} );
		if ( best === current ) {
			return;
		}
		if ( current ) {
			pause( current );
		}
		current = best;
		if ( current ) {
			play( current );
		}
	}

	function observe( nodes ) {
		if ( ! nodes.length ) {
			return;
		}
		if ( ! ( 'IntersectionObserver' in window ) || 'undefined' === typeof Map ) {
			return; /* No observer: the players keep their own controls. */
		}
		ratios = new Map();
		nodes.forEach( function ( node ) {
			ratios.set( node, 0 );
		} );
		var io = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					ratios.set( entry.target, entry.isIntersecting ? entry.intersectionRatio : 0 );
				} );
				arbitrate();
			},
			/* A fine threshold list, because the arbitration is a COMPARISON:
			   with only 0/0.35/0.75 two players sitting between steps would
			   report the same ratio and the winner would be arbitrary. */
			{ threshold: [ 0, 0.1, 0.2, 0.35, 0.5, 0.65, 0.8, 0.95 ] }
		);
		nodes.forEach( function ( node ) {
			io.observe( node );
		} );
	}

	/* The featured-image play/pause button: the visible way in, and the only
	   control a reader gets when reduced motion is on. */
	function wireFeaturedButtons() {
		var wraps = document.querySelectorAll( '[data-arneiron-feat-video]' );
		Array.prototype.forEach.call( wraps, function ( wrap ) {
			var video = wrap.querySelector( 'video' );
			var btn = wrap.querySelector( '.arneiron-feat-video__btn' );
			if ( ! video || ! btn ) {
				return;
			}
			function sync() {
				var playing = ! video.paused && ! video.ended;
				wrap.classList.toggle( 'is-playing', playing );
				btn.setAttribute(
					'aria-label',
					playing ? ( STRINGS.pause || 'Pause video' ) : ( STRINGS.play || 'Play video' )
				);
			}
			btn.addEventListener( 'click', function () {
				if ( video.paused ) {
					/* Take the page's one play slot, or the next observer
					   callback would pause what the reader just started. */
					if ( current && current !== video ) {
						pause( current );
					}
					current = video;
					video.muted = true;
					var p = video.play();
					if ( p && p.catch ) {
						p.catch( function () {} );
					}
					if ( ours ) {
						ours.add( video );
					}
				} else {
					video.pause();
					if ( current === video ) {
						current = null;
					}
				}
			} );
			video.addEventListener( 'play', sync );
			video.addEventListener( 'pause', sync );
			sync();
		} );
	}

	/* Fit to the screen (assets/css/media-video.css): the stylesheet needs the
	   sticky header's height, which differs per breakpoint and per site
	   setting, and the shape of any video PHP could not stamp. */
	function measureHeader() {
		var header = document.querySelector( '.wp-site-blocks > header' );
		var h = 0;
		if ( header ) {
			var pos = window.getComputedStyle( header ).position;
			if ( 'sticky' === pos || 'fixed' === pos ) {
				h = Math.round( header.getBoundingClientRect().height );
			}
		}
		document.documentElement.style.setProperty( '--arneiron-header-h', h + 'px' );
	}

	function stampRatio( video ) {
		if ( video.style.getPropertyValue( '--arneiron-video-ar' ) || ! video.videoWidth || ! video.videoHeight ) {
			return;
		}
		video.style.setProperty( '--arneiron-video-ar', video.videoWidth + ' / ' + video.videoHeight );
	}

	function fitToScreen() {
		measureHeader();
		window.addEventListener( 'resize', measureHeader, { passive: true } );
		Array.prototype.forEach.call( document.querySelectorAll( 'figure.wp-block-video video' ), function ( video ) {
			if ( video.readyState >= 1 ) {
				stampRatio( video );
			} else {
				video.addEventListener( 'loadedmetadata', function () {
					stampRatio( video );
				}, { once: true } );
			}
		} );
	}

	function init() {
		fitToScreen();
		wireFeaturedButtons();
		observe(
			Array.prototype.slice.call(
				document.querySelectorAll( 'video[data-arneiron-autoplay], iframe[data-arneiron-autoplay]' )
			)
		);
		document.addEventListener( 'visibilitychange', function () {
			if ( ! document.hidden ) {
				return;
			}
			Array.prototype.forEach.call(
				document.querySelectorAll( 'video[data-arneiron-autoplay], iframe[data-arneiron-autoplay]' ),
				pause
			);
			current = null;
		} );
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
}() );
