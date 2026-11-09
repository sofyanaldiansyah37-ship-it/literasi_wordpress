/**
 * ArneIron — "Scroll Story" post template (enqueued only on such posts).
 *
 * Desktop (>= 900px, motion allowed): the post content becomes a column of
 * sections; a sticky panel beside it shows the image of the section being read
 * and crossfades when the next section's text reaches the middle of the
 * visible window (below a sticky header). The panel is centred vertically in
 * that visible area. A section is a group with the "Scroll Story section"
 * style, or, when the post has none, every image or video in the content plus
 * the text after it (a picture directly followed by another picture stays
 * inline). The inline media stay in the page for assistive technology
 * (visually hidden); the panel is aria-hidden.
 *
 * A video section (core/video) shows its clip in the panel as a muted, looping
 * <video> with the block's poster. It plays only while its section is the one
 * being read and the tab is visible; every other panel clip is paused. Before
 * the reader reaches the first section, the panel shows the poster and plays
 * nothing, so it never competes with a video above the sections.
 *
 * Phones, reduced motion, no JavaScript: nothing changes — images and videos
 * stay inline, above their text, with their alt text and controls.
 *
 * Also: the "Copy link" share button copies the permalink.
 */
( function () {
	'use strict';

	var root = document.querySelector( '.scroll-story' );
	var content = root && root.querySelector( '.scroll-story__content' );
	var body = content && content.parentElement;
	var wide = window.matchMedia( '(min-width: 900px)' );
	var calm = window.matchMedia( '(prefers-reduced-motion: reduce)' );
	var rail = null;
	var stage = null;
	var secs = [];
	var queued = false;
	var marked = [];

	var MEDIA = '.wp-block-image, .wp-block-video';

	// The picture a media block puts in the panel: an <img>, or a <video> that
	// has a source to play.
	function media( fig ) {
		if ( fig.matches( '.wp-block-video' ) ) {
			var v = fig.querySelector( 'video' );
			return v && ( v.currentSrc || v.src || v.querySelector( 'source[src]' ) ) ? { video: v } : null;
		}
		var img = fig.querySelector( 'img' );
		return img ? { img: img } : null;
	}

	function sections() {
		var out = [];
		var explicit = content.querySelectorAll( ':scope > .is-style-scroll-section' );
		if ( explicit.length ) {
			explicit.forEach( function ( g ) {
				var fig = g.querySelector( MEDIA );
				var m = fig && media( fig );
				if ( m ) {
					out.push( { start: g, watch: g, fig: fig, img: m.img, video: m.video } );
				}
			} );
			return out;
		}
		Array.prototype.forEach.call( content.children, function ( el ) {
			// A picture starts a section only when text follows it; a picture
			// followed by another picture (a run of them) stays inline.
			var next = el.nextElementSibling;
			if ( el.matches( MEDIA ) && next && ! next.matches( MEDIA ) ) {
				var m = media( el );
				if ( m ) {
					// The picture itself is hidden once the panel takes over, so the
					// section is watched through the first block after it.
					out.push( { start: el, watch: next, fig: el, img: m.img, video: m.video } );
				}
			}
		} );
		return out;
	}

	// Panel clips: only the active one plays, and only once its section has
	// been reached and the tab is visible.
	var reached = false;

	function clips() {
		var active = -1;
		if ( stage && reached && ! document.hidden ) {
			Array.prototype.forEach.call( stage.children, function ( f, n ) {
				if ( f.classList.contains( 'is-active' ) ) {
					active = n;
				}
			} );
		}
		if ( ! stage ) {
			return;
		}
		Array.prototype.forEach.call( stage.children, function ( f, n ) {
			var v = f.querySelector( 'video' );
			if ( ! v ) {
				return;
			}
			if ( n === active ) {
				v.muted = true;
				var p = v.play();
				if ( p && p.catch ) {
					p.catch( function () {
						// Blocked or a codec the browser will not start: the
						// poster stays, which is what the panel showed anyway.
					} );
				}
			} else if ( ! v.paused ) {
				v.pause();
			}
		} );
	}

	function activate( i ) {
		if ( ! rail ) {
			return;
		}
		Array.prototype.forEach.call( stage.children, function ( f, n ) {
			f.classList.toggle( 'is-active', n === i );
		} );
		clips();
	}

	function teardown() {
		secs = [];
		stage = null;
		if ( rail ) {
			Array.prototype.forEach.call( rail.querySelectorAll( 'video' ), function ( v ) {
				v.pause();
			} );
			rail.remove();
			rail = null;
		}
		reached = false;
		marked.forEach( function ( el ) {
			el.classList.remove( 'scroll-story__src' );
		} );
		Array.prototype.forEach.call( document.querySelectorAll( '[data-scroll-story-index]' ), function ( el ) {
			el.removeAttribute( 'data-scroll-story-index' );
		} );
		marked = [];
		if ( body ) {
			body.classList.remove( 'is-scroll-story-ready' );
		}
	}

	function build() {
		secs = sections();
		if ( ! secs.length ) {
			return;
		}
		rail = document.createElement( 'aside' );
		rail.className = 'scroll-story__rail';
		rail.setAttribute( 'aria-hidden', 'true' );
		stage = document.createElement( 'div' );
		stage.className = 'scroll-story__stage';
		rail.appendChild( stage );
		secs.forEach( function ( s, n ) {
			var f = document.createElement( 'figure' );
			f.className = 'scroll-story__frame' + ( 0 === n ? ' is-active' : '' );
			if ( s.video ) {
				// The inline clip is hidden while the panel shows its copy; it
				// must not keep playing (or downloading) out of sight.
				if ( ! s.video.paused ) {
					s.video.pause();
				}
				var src = s.video.currentSrc || s.video.src;
				if ( ! src ) {
					var source = s.video.querySelector( 'source[src]' );
					src = source ? source.src : '';
				}
				var v = document.createElement( 'video' );
				v.muted = true;
				v.defaultMuted = true;
				v.loop = true;
				v.playsInline = true;
				v.setAttribute( 'muted', '' );
				v.setAttribute( 'playsinline', '' );
				v.setAttribute( 'disablepictureinpicture', '' );
				v.preload = 'metadata';
				if ( s.video.poster ) {
					v.poster = s.video.poster;
				}
				v.src = src;
				v.addEventListener( 'loadedmetadata', offset );
				f.appendChild( v );
				f.classList.add( 'is-video' );
			} else {
				var img = document.createElement( 'img' );
				img.src = s.img.currentSrc || s.img.src;
				if ( s.img.srcset ) {
					img.srcset = s.img.srcset;
					img.sizes = '(min-width: 900px) 33vw, 100vw';
				}
				img.alt = '';
				img.loading = 'eager';
				img.addEventListener( 'load', offset );
				f.appendChild( img );
			}
			var cap = s.fig.querySelector( 'figcaption' );
			if ( cap ) {
				var c = document.createElement( 'figcaption' );
				c.textContent = cap.textContent;
				f.appendChild( c );
			}
			stage.appendChild( f );
			s.fig.classList.add( 'scroll-story__src' );
			marked.push( s.fig );
			s.watch.setAttribute( 'data-scroll-story-index', String( n ) );
		} );
		body.appendChild( rail );
		body.classList.add( 'is-scroll-story-ready' );
		offset();
		pick();
	}

	// The visible area starts below a sticky/fixed header and the admin bar.
	function offset() {
		var top = 0;
		var header = document.querySelector( '.wp-site-blocks > header, .wp-site-blocks > .wp-block-template-part' );
		if ( header ) {
			var pos = getComputedStyle( header ).position;
			if ( 'sticky' === pos || 'fixed' === pos ) {
				top = Math.max( 0, header.getBoundingClientRect().bottom );
			}
		}
		if ( ! top ) {
			var bar = document.getElementById( 'wpadminbar' );
			top = bar && 'fixed' === getComputedStyle( bar ).position ? bar.offsetHeight : 0;
		}
		document.documentElement.style.setProperty( '--scroll-story-top', Math.round( top ) + 'px' );
		if ( stage ) {
			var free = window.innerHeight - top - stage.offsetHeight;
			stage.style.setProperty( '--scroll-story-stick', Math.round( top + Math.max( 0, free / 2 ) ) + 'px' );
		}
	}

	// The section shown is the last one whose text has reached the middle of
	// the visible area — so the image matches the text at the centre of the screen.
	function pick() {
		queued = false;
		if ( ! rail ) {
			return;
		}
		var top = parseFloat( getComputedStyle( document.documentElement ).getPropertyValue( '--scroll-story-top' ) ) || 0;
		var middle = top + ( window.innerHeight - top ) / 2;
		var active = 0;
		var any = false;
		secs.forEach( function ( s, n ) {
			if ( s.watch.getBoundingClientRect().top <= middle ) {
				active = n;
				any = true;
			}
		} );
		reached = any;
		activate( active );
	}

	function onScroll() {
		if ( ! queued ) {
			queued = true;
			window.requestAnimationFrame( pick );
		}
	}

	function update() {
		teardown();
		if ( content && body && wide.matches && ! calm.matches ) {
			build();
		}
	}

	if ( content && body ) {
		update();
		window.addEventListener( 'scroll', onScroll, { passive: true } );
		window.addEventListener( 'resize', function () {
			offset();
			onScroll();
		} );
		[ wide, calm ].forEach( function ( m ) {
			if ( m.addEventListener ) {
				m.addEventListener( 'change', update );
			}
		} );
		document.addEventListener( 'visibilitychange', clips );
	}

	document.addEventListener( 'click', function ( e ) {
		var a = e.target.closest && e.target.closest( 'a[data-arneiron-copy]' );
		if ( ! a || ! navigator.clipboard ) {
			return;
		}
		e.preventDefault();
		navigator.clipboard.writeText( a.href ).then( function () {
			var label = ( window.arneironScrollStory && window.arneironScrollStory.copied ) || 'Link copied';
			a.setAttribute( 'title', label );
			a.classList.add( 'is-copied' );
			window.setTimeout( function () {
				a.classList.remove( 'is-copied' );
			}, 1600 );
		} );
	} );
}() );
