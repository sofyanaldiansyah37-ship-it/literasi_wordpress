/* =============================================================================
   ArneIron — progressive enhancement (assets/js/theme.js)
   =============================================================================
   ≤ 2 KB gzipped. defer-ed. The site works without it (progressive-enhancement
   skill). Adds small niceties only: a class-toggle for the mobile nav disclosure
   so the [aria-expanded] state is mirrored, and a reduced-motion guard.
   ========================================================================== */

( function () {
	'use strict';

	/**
	 * Mirror the navigation block's disclosure state onto the body for CSS hooks.
	 * The block already opens/closes itself; we just expose the state so CSS can
	 * adjust spacing without a FOUC.
	 */
	function bindNavDisclosure() {
		var navs = document.querySelectorAll( '.wp-block-navigation' );
		navs.forEach( function ( nav ) {
			var btn = nav.querySelector( '[aria-expanded]' );
			if ( ! btn ) { return; }

			var update = function () {
				document.body.classList.toggle( 'nav-open', btn.getAttribute( 'aria-expanded' ) === 'true' );
			};
			btn.addEventListener( 'click', update );
			update();
		} );
	}

	/**
	 * Mark images as loaded so .is-loaded CSS can fade them in without a layout
	 * shift (CLS-safe). Respects reduced motion by skipping the transition.
	 */
		/**
		 * Mobile bar my-account dropdown: toggle the menu and mirror state to
		 * [aria-expanded]; close on outside click or Escape. Progressive enhancement
		 * only — without JS the menu is keyboard-reachable and no-js users get it
		 * unconditionally (see .no-js override in ds.css).
		 */
		/**
		 * Mobile drawer (off-canvas). Toggles [data-state] on the
		 * #arneiron-mobile-menu root when any [data-nav-toggle] element (the
		 * hamburger) OR any [data-nav-close] element (scrim + close button) is
		 * clicked. Mirrors aria-hidden / aria-modal so the dialog is accessible,
		 * closes on Escape, and traps the focus inside the panel while open.
		 * Progressive enhancement — without JS the drawer stays closed and the
		 * inline header bar remains usable (no FOUC).
		 */
		function bindMobileMenu() {
			var drawers = document.querySelectorAll( '.arneiron-mobile-drawer' );
			if ( ! drawers.length ) { return; }

			drawers.forEach( function ( drawer ) {
				var panel = drawer.querySelector( '.arneiron-mobile-drawer__panel' );
				// Theme 0.9.1: the drawer is a core/group (which cannot save data-* /
				// aria-* attributes), so its dialog semantics are applied here.
				if ( ! drawer.hasAttribute( 'data-state' ) ) { drawer.setAttribute( 'data-state', 'closed' ); }
				drawer.setAttribute( 'role', 'dialog' );
				drawer.setAttribute( 'aria-modal', 'false' );
				drawer.setAttribute( 'aria-hidden', 'true' );
				if ( ! drawer.hasAttribute( 'aria-label' ) ) { drawer.setAttribute( 'aria-label', ( window.arneironThemeI18n && window.arneironThemeI18n.mobileMenu ) || 'Mobile menu' ); }
				if ( panel ) { panel.setAttribute( 'role', 'document' ); }
				var toggles = document.querySelectorAll( '[data-nav-toggle]' );
				var opener  = null;
				var setExpanded = function ( v ) {
					toggles.forEach( function ( t ) { t.setAttribute( 'aria-expanded', v ? 'true' : 'false' ); } );
				};
				// What Tab can reach inside the open panel (visible, enabled).
				var focusables = function () {
					return Array.prototype.filter.call(
						( panel || drawer ).querySelectorAll( 'a[href], button:not([disabled]), input:not([disabled]):not([type="hidden"]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])' ),
						function ( el ) { return el.offsetWidth > 0 || el.offsetHeight > 0 || el.getClientRects().length > 0; }
					);
				};
				var open  = function () {
					opener = document.activeElement;
					drawer.setAttribute( 'data-state', 'open' );
					drawer.setAttribute( 'aria-hidden', 'false' );
					drawer.setAttribute( 'aria-modal', 'true' );
					document.body.classList.add( 'mobile-drawer-open' );
					setExpanded( true );
					// Push focus into the panel for keyboard users.
					var first = focusables()[ 0 ];
					if ( first ) { first.focus(); }
				};
				var close = function () {
					var had = drawer.contains( document.activeElement );
					drawer.setAttribute( 'data-state', 'closed' );
					drawer.setAttribute( 'aria-hidden', 'true' );
					drawer.setAttribute( 'aria-modal', 'false' );
					document.body.classList.remove( 'mobile-drawer-open' );
					setExpanded( false );
					// Back to the button that opened it (or the first toggle).
					if ( had ) {
						var back = ( opener && opener.hasAttribute && opener.hasAttribute( 'data-nav-toggle' ) ) ? opener : toggles[ 0 ];
						if ( back ) { back.focus(); }
					}
				};
				var toggle = function () {
					if ( drawer.getAttribute( 'data-state' ) === 'open' ) { close(); } else { open(); }
				};

				// Hamburger open buttons.
				document.querySelectorAll( '[data-nav-toggle]' ).forEach( function ( btn ) {
					btn.addEventListener( 'click', function ( ev ) { ev.preventDefault(); toggle(); } );
				} );
				// Scrim + close buttons inside the drawer.
				drawer.querySelectorAll( '[data-nav-close]' ).forEach( function ( btn ) {
					btn.addEventListener( 'click', function ( ev ) { ev.preventDefault(); close(); } );
				} );
				// While open: Escape closes it (from anywhere), and Tab / Shift+Tab
				// cycle inside the panel (it is a modal dialog).
				document.addEventListener( 'keydown', function ( ev ) {
					if ( drawer.getAttribute( 'data-state' ) !== 'open' ) { return; }
					if ( ev.key === 'Escape' ) { ev.preventDefault(); close(); return; }
					if ( ev.key !== 'Tab' ) { return; }
					var list = focusables();
					if ( ! list.length ) { return; }
					var first = list[ 0 ], last = list[ list.length - 1 ];
					if ( ! drawer.contains( document.activeElement ) ) { ev.preventDefault(); first.focus(); }
					else if ( ev.shiftKey && document.activeElement === first ) { ev.preventDefault(); last.focus(); }
					else if ( ! ev.shiftKey && document.activeElement === last ) { ev.preventDefault(); first.focus(); }
				} );
			} );
		}

		/* Binds every header disclosure that follows the trigger+menu-as-siblings
		   shape: my-account, and the Polylang language switcher. Both selectors
		   are listed explicitly rather than generalised to a data-attribute so
		   the existing account markup keeps working unchanged. */
		function bindAccountDropdown() {
			var triggers = document.querySelectorAll( '.arneiron-account-toggle[aria-expanded], .arneiron-lang-toggle[aria-expanded]' );
			triggers.forEach( function ( trigger ) {
				var menu = trigger.parentElement && trigger.parentElement.querySelector( '.arneiron-account-menu, .arneiron-lang-menu' );
				if ( ! menu ) { return; }

				var open  = function () {
					trigger.setAttribute( 'aria-expanded', 'true' );
					menu.hidden = false;
					menu.setAttribute( 'aria-hidden', 'false' );
				};
				var close = function () {
					trigger.setAttribute( 'aria-expanded', 'false' );
					menu.hidden = true;
					menu.setAttribute( 'aria-hidden', 'true' );
				};

				trigger.addEventListener( 'click', function ( ev ) {
					ev.preventDefault();
					if ( trigger.getAttribute( 'aria-expanded' ) === 'true' ) { close(); } else { open(); }
				} );

				/* `trigger.contains()`, not `ev.target !== trigger`. Both triggers
				   wrap their label in spans (an icon and a code/screen-reader
				   span), so a click almost always lands on a CHILD of the
				   button. An identity check therefore treats the trigger's own
				   click as an outside click and closes the menu in the same
				   event pass that opened it — the disclosure never appears. */
				document.addEventListener( 'click', function ( ev ) {
					if ( ! menu.contains( ev.target ) && ! trigger.contains( ev.target ) ) { close(); }
				} );
				document.addEventListener( 'keydown', function ( ev ) {
					if ( ev.key === 'Escape' ) { close(); }
				} );
			} );
		}

	/* My Account tabs. Roving tabindex + arrow keys, per the APG tabs pattern:
	   only the selected tab is in the tab order, and Left/Right move between
	   tabs. Without it the tablist is a row of buttons a keyboard user has to
	   tab through one at a time. */
	function bindAccountTabs() {
		document.querySelectorAll( '[data-account-tabs]' ).forEach( function ( root ) {
			var tabs = Array.prototype.slice.call( root.querySelectorAll( '[role="tab"]' ) );
			if ( ! tabs.length ) { return; }

			function select( tab ) {
				tabs.forEach( function ( t ) {
					var on = t === tab;
					t.setAttribute( 'aria-selected', on ? 'true' : 'false' );
					t.tabIndex = on ? 0 : -1;
					var panel = document.getElementById( t.getAttribute( 'aria-controls' ) );
					if ( panel ) { panel.hidden = ! on; }
				} );
			}

			tabs.forEach( function ( tab, i ) {
				tab.addEventListener( 'click', function () { select( tab ); } );
				tab.addEventListener( 'keydown', function ( ev ) {
					var next = null;
					if ( ev.key === 'ArrowRight' ) { next = tabs[ ( i + 1 ) % tabs.length ]; }
					if ( ev.key === 'ArrowLeft' )  { next = tabs[ ( i - 1 + tabs.length ) % tabs.length ]; }
					if ( ev.key === 'Home' )       { next = tabs[ 0 ]; }
					if ( ev.key === 'End' )        { next = tabs[ tabs.length - 1 ]; }
					if ( ! next ) { return; }
					ev.preventDefault();
					select( next );
					next.focus();
				} );
			} );
		} );
	}

	function markLoadedImages() {
		var imgs = document.querySelectorAll( 'img' );
		imgs.forEach( function ( img ) {
			if ( ! img ) { return; }
			if ( img.complete ) {
				img.classList.add( 'is-loaded' );
			} else {
				img.addEventListener( 'load',  function () { img.classList.add( 'is-loaded' ); } );
				img.addEventListener( 'error', function () { img.classList.add( 'has-error' ); } );
			}
		} );
	}


	/**
	 * Centre the menu on the BAND, but only when the header can actually hold it.
	 *
	 * ds.css §4h can centre the nav by taking it out of flow and pinning it to
	 * the middle of the full-bleed wrapper. What CSS cannot do is decide WHETHER
	 * that fits, and the arithmetic is unforgiving: an out-of-flow menu no longer
	 * pushes the control cluster aside, so a centred menu clears both sides only
	 * while
	 *
	 *     menu + 2 * max(brand, controls)  <=  row
	 *
	 * Measured on dev at 1280px: menu 514, controls 392, row 1201 — it needs
	 * 1298 and the controls end up 47.8px ON TOP of the last menu item. At
	 * 1440px the same header needs 1300 of a 1300px row and clears by 1.6px.
	 * A media query is a proxy for that test, and a wrong proxy is an overlap
	 * shipped to a customer; the widest menu in this estate flips the answer
	 * between 1438 and 1440px, which no round number expresses.
	 *
	 * So the test is the real one, and the class it toggles is what ds.css keys
	 * the centring on. With JavaScript off the class is never added and the
	 * in-flow auto-margin layout runs — off-centre, never overlapping, which is
	 * the correct failure direction.
	 */
	function bindCentredNav() {
		var header = document.querySelector( '.app-header' );
		if ( ! header ) {
			return;
		}
		var nav = header.querySelector( ':scope > .app-nav' );
		var brand = header.querySelector( ':scope > .brand' );
		if ( ! nav ) {
			return;
		}

		function widest() {
			var w = brand ? brand.getBoundingClientRect().width : 0;
			var kids = header.children;
			var trailing = 0;
			for ( var i = 0; i < kids.length; i++ ) {
				var k = kids[ i ];
				if ( k === nav || k === brand ) {
					continue;
				}
				var b = k.getBoundingClientRect();
				if ( b.width > 0 ) {
					// The cluster is measured end to end, gaps included: what has
					// to be cleared is the span it occupies, not the sum of its
					// parts.
					trailing = Math.max( trailing, header.getBoundingClientRect().right - b.left );
				}
			}
			return Math.max( w, trailing );
		}

		function fits() {
			// Measure the menu ITEMS, not the nav box: once centred the nav spans
			// the whole band by design, so measuring the nav would compare the
			// band against itself and always answer "no".
			var list = nav.querySelector( '.wp-block-navigation__container' );
			var items = list ? list.children : null;
			if ( ! items || ! items.length ) {
				return false;
			}
			var first = items[ 0 ].getBoundingClientRect();
			var last = items[ items.length - 1 ].getBoundingClientRect();
			var menu = last.right - first.left;
			var row = header.getBoundingClientRect().width;
			return menu > 0 && menu + 2 * widest() <= row;
		}

		function apply() {
			// Re-measure from the UNCENTRED state every time, or the answer is
			// taken against a layout the answer itself produced.
			header.classList.remove( 'has-centred-nav' );
			if ( fits() ) {
				header.classList.add( 'has-centred-nav' );
			}
		}

		apply();
		var t = null;
		window.addEventListener( 'resize', function () {
			window.clearTimeout( t );
			t = window.setTimeout( apply, 100 );
		} );
		// Web fonts change the menu's width after first paint, and the answer
		// with fallback metrics is not the answer with the real ones.
		if ( document.fonts && document.fonts.ready ) {
			document.fonts.ready.then( apply ).catch( function () {} );
		}
	}

	/* Drawer navigation: core's submenus and mega panels, as drill-down levels.
	   ---------------------------------------------------------------------------
	   The drawer renders the real primary navigation, which brings core's own
	   submenu behaviour with it. That behaviour is a DROPDOWN, and a dropdown
	   inside a 320px off-canvas column is unusable — worse for the mega item,
	   whose panel is a full pattern. So each level is promoted to a panel of its
	   own that slides in over the previous one, with a Back button.

	   THE LISTENER IS ON THE CAPTURE PHASE, AND THAT IS THE WHOLE TRICK. Core
	   attaches its Interactivity API click handler to the submenu toggle itself
	   (`data-wp-on--click`). A bubble-phase listener here would run AFTER that
	   handler had already toggled core's own open state, leaving two systems
	   disagreeing about whether the submenu is open. Capturing on the nav means
	   this runs first, and `stopPropagation()` keeps the event from ever
	   reaching core's handler.

	   The Back button is built on first open rather than up front: a drawer with
	   several mega panels would otherwise clone a button into every panel on
	   every page load, including the panels a visitor never opens. */
	function bindDrawerNav() {
		var navs = document.querySelectorAll( '.arneiron-mobile-drawer [data-drawer-nav], .arneiron-mobile-drawer .arneiron-mobile-nav-wrap' );
		if ( ! navs.length ) { return; }

		navs.forEach( function ( nav ) {
			var drawer = nav.closest( '.arneiron-mobile-drawer' );

			function closeAll() {
				nav.querySelectorAll( '.has-child.arneiron-drawer-level-open' ).forEach( function ( item ) {
					closeLevel( item );
				} );
			}

			/* The open class goes on the PANEL, not the item — see ds.css §14d:
			   keyed off the item it matched and still lost to core's navigation
			   stylesheet. The item keeps a marker class for anything that needs
			   to style the row itself. */
			function panelOf( item ) {
				return item.querySelector( '.wp-block-navigation__submenu-container' );
			}

			function addBack( item ) {
				var panel = item.querySelector( '.wp-block-navigation__submenu-container' );
				if ( ! panel || panel.querySelector( '.arneiron-drawer-back' ) ) { return; }

				var label = item.querySelector( '.wp-block-navigation-item__label' );
				var btn   = document.createElement( 'button' );
				var arrow = document.createElement( 'span' );
				var text  = document.createElement( 'span' );

				btn.type      = 'button';
				btn.className = 'arneiron-drawer-back';
				arrow.className = 'arneiron-drawer-back__arrow';
				arrow.setAttribute( 'aria-hidden', 'true' );
				arrow.textContent = '←';
				/* The label names where Back goes, so a screen reader hears
				   "Back, Widgets" rather than an unqualified "Back" repeated
				   once per level. textContent, never innerHTML: the label is
				   author-supplied menu text. */
				text.textContent = label ? label.textContent : 'Back';

				btn.appendChild( arrow );
				btn.appendChild( text );
				btn.addEventListener( 'click', function ( ev ) {
					ev.preventDefault();
					ev.stopPropagation();
					closeLevel( item );
				} );
				panel.insertBefore( btn, panel.firstChild );
			}

			/* THE OPEN STATE IS SET INLINE, DELIBERATELY.
			   -------------------------------------------------------------------
			   Three CSS formulations of "this level is open" were written and
			   measured on 2026-09-02 — keyed off the item, off the panel, and at
			   (0,5,0) against core's (0,3,0). In every one the class was present,
			   `element.matches()` returned true for the selector, and the computed
			   visibility stayed `hidden`: core's navigation stylesheet kept the
			   panel closed by a route that outranked all three.

			   An inline style cannot be outranked by any stylesheet, so the state
			   is written directly onto the element and cleared by assigning ''.
			   The CLOSED state, the geometry and the transition all stay in
			   ds.css §14d — only the two properties that flip are inline, so
			   removing them returns the panel to the stylesheet's own definition
			   and the slide still animates. */
			function openLevel( item ) {
				var panel = panelOf( item );
				if ( ! panel ) { return; }
				addBack( item );
				item.classList.add( 'arneiron-drawer-level-open' );
				panel.classList.add( 'arneiron-drawer-level-open' );
				panel.style.visibility = 'visible';
				panel.style.transform  = 'translateX(0)';
			}

			function closeLevel( item ) {
				var panel = panelOf( item );
				item.classList.remove( 'arneiron-drawer-level-open' );
				if ( panel ) {
					panel.classList.remove( 'arneiron-drawer-level-open' );
					panel.style.visibility = '';
					panel.style.transform  = '';
				}
			}

			nav.addEventListener( 'click', function ( ev ) {
				/* A click INSIDE an open level is an ordinary click: its links
				   must navigate and its Back button must run its own handler.
				   This test comes first because the panel is a descendant of
				   the item, so `closest('.has-child')` matches for those too —
				   without it, every link inside a mega panel would re-open the
				   level it is already in and never navigate. */
				if ( ev.target.closest( '.wp-block-navigation__submenu-container' ) ) {
					return;
				}

				var item = ev.target.closest( '.has-child' );
				if ( ! item || ! nav.contains( item ) ) { return; }

				/* THE WHOLE ROW OPENS THE LEVEL, not just the chevron.
				   Reported 2026-09-02: "on clicking menu item nothing happend".
				   This listener used to accept only
				   `.wp-block-navigation__submenu-icon` / the submenu toggle, but
				   a mega item with a URL renders its label as an <a> — so a tap
				   on the label (what a person actually aims at) either navigated
				   away or, with an empty href, did nothing at all. Worse, the
				   chevron is rendered ONLY when the parent navigation block has
				   "Show arrow" on, so on a site with it off there was no target
				   to hit at all.

				   Opening from the row is also the phone convention: the parent
				   is a way in to its children, and its own page stays reachable
				   from inside the level. */
				ev.preventDefault();
				ev.stopPropagation();
				openLevel( item );
			}, true );

			/* Closing the drawer resets it, so reopening never lands the user
			   three levels deep in a menu they left minutes ago. */
			if ( drawer ) {
				drawer.querySelectorAll( '[data-nav-close]' ).forEach( function ( btn ) {
					btn.addEventListener( 'click', closeAll );
				} );
				drawer.addEventListener( 'keydown', function ( ev ) {
					if ( ev.key === 'Escape' ) { closeAll(); }
				} );
			}
		} );
	}

	/* Keyboard access to content that scrolls sideways (a wide table, a <pre>
	   with long lines, a horizontal card strip): a region that scrolls must be
	   reachable with Tab so it can be scrolled with the arrow keys (WCAG 2.1.1).
	   Only regions that actually overflow get tabindex, and they lose it again
	   when a resize makes them fit. */
	function bindScrollableRegions() {
		var sel = 'pre, .wp-block-table, .arneiron-scroll-x';
		var update = function () {
			document.querySelectorAll( sel ).forEach( function ( el ) {
				var scrolls = el.scrollWidth > el.clientWidth + 1 && 'visible' !== getComputedStyle( el ).overflowX;
				if ( scrolls && ! el.hasAttribute( 'tabindex' ) ) {
					el.setAttribute( 'tabindex', '0' );
					el.setAttribute( 'data-arneiron-scroll-focus', '' );
				} else if ( ! scrolls && el.hasAttribute( 'data-arneiron-scroll-focus' ) ) {
					el.removeAttribute( 'tabindex' );
					el.removeAttribute( 'data-arneiron-scroll-focus' );
				}
			} );
		};
		update();
		window.addEventListener( 'resize', update );
		window.addEventListener( 'load', update );
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		bindScrollableRegions();
		bindNavDisclosure();
		bindCentredNav();
		bindMobileMenu();
		bindDrawerNav();
		bindAccountDropdown();
		bindAccountTabs();
		markLoadedImages();
	} );
}() );
