/**
 * ArneIron — comment box (inc/comment-box.php).
 *
 * Collapsed: one line ("What are your thoughts?"); the name/email fields and the
 * buttons are out of the way. Focus or typing expands it: the textarea grows
 * and Cancel + Comment appear. Cancel collapses it and keeps the text (and
 * returns a moved reply form to its place); Esc collapses an empty box; so does
 * focus leaving an empty form. aria-expanded on the box group tracks the state.
 * Without this script the normal full form shows.
 */
( function () {
	'use strict';

	function init( box ) {
		var form = box.closest( 'form' );
		var ta = box.querySelector( 'textarea' );
		var cancel = form && form.querySelector( '.arneiron-comment-box__cancel' );
		if ( ! form || ! ta || ! cancel || form.classList.contains( 'arneiron-comment-form--enhanced' ) ) {
			return;
		}
		var quiet = false;

		function set( open ) {
			form.classList.toggle( 'is-expanded', open );
			box.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		}
		function replying() {
			var link = document.getElementById( 'cancel-comment-reply-link' );
			return link && 'none' !== link.style.display ? link : null;
		}

		form.classList.add( 'arneiron-comment-form--enhanced' );
		cancel.hidden = false;
		set( '' !== ta.value.trim() || !! replying() );

		ta.addEventListener( 'focus', function () {
			if ( quiet ) {
				quiet = false;
				return;
			}
			set( true );
		} );
		ta.addEventListener( 'input', function () {
			set( true );
		} );
		cancel.addEventListener( 'click', function () {
			var link = replying();
			if ( link ) {
				link.click(); // comment-reply.js puts the form back under the post.
			}
			set( false );
			quiet = true;
			ta.focus();
		} );
		ta.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key && '' === ta.value.trim() ) {
				set( false );
			}
		} );
		form.addEventListener( 'focusout', function ( e ) {
			if ( form.contains( e.relatedTarget ) || '' !== ta.value.trim() || replying() ) {
				return;
			}
			set( false );
		} );
		// Reply links (comment-reply.js) move the form and focus the textarea:
		// make sure it opens even if focus was already there.
		document.addEventListener( 'click', function ( e ) {
			if ( e.target.closest && e.target.closest( '.comment-reply-link' ) ) {
				window.setTimeout( function () {
					set( true );
				}, 0 );
			}
		} );
	}

	function run() {
		Array.prototype.forEach.call( document.querySelectorAll( '.arneiron-comment-box' ), init );
	}
	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', run );
	} else {
		run();
	}
}() );
