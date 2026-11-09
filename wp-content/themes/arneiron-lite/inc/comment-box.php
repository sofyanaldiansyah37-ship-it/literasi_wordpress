<?php
/**
 * Comment box: collapsed to one line until it is used, then it grows and shows
 * its two buttons (Cancel, Comment) — the behaviour of the vania-novikau.me
 * comment form, for every post.
 *
 * Theme-side, progressive enhancement over core's comment_form() (so the core
 * fields, spam plugins and comment-reply.js keep working):
 *   - comment_form_defaults wraps the textarea in .arneiron-comment-box, gives
 *     it a placeholder, labels the submit "Comment" and adds a Cancel button
 *     (hidden until the script runs) to the submit row;
 *   - assets/js/comment-box.js + assets/css/comment-box.css (only on singular
 *     views with comments open) collapse the box, expand it on focus or input,
 *     and collapse it on Cancel, on Esc when empty and when focus leaves an
 *     empty form. Without JavaScript the full normal form shows.
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'arneiron_comment_box_defaults' ) ) {
	/**
	 * Wrap the textarea, add the placeholder and the Cancel button.
	 *
	 * @param array $defaults comment_form() defaults.
	 * @return array
	 */
	function arneiron_comment_box_defaults( $defaults ) {
		$field = isset( $defaults['comment_field'] ) ? (string) $defaults['comment_field'] : '';
		if ( '' === $field || false !== strpos( $field, 'arneiron-comment-box' ) ) {
			return $defaults;
		}
		$p = new WP_HTML_Tag_Processor( $field );
		if ( $p->next_tag( 'textarea' ) ) {
			if ( null === $p->get_attribute( 'placeholder' ) ) {
				$p->set_attribute( 'placeholder', __( 'What are your thoughts?', 'arneiron-lite' ) );
			}
			$p->set_attribute( 'rows', '4' );
			$field = $p->get_updated_html();
		}
		$field = preg_replace(
			'#(<textarea\b.*?</textarea>)#s',
			'<span class="arneiron-comment-box" role="group" aria-label="' . esc_attr__( 'Write a comment', 'arneiron-lite' ) . '" aria-expanded="true">$1</span>',
			$field,
			1
		);
		$defaults['comment_field'] = $field;

		$cancel                   = '<button type="button" class="arneiron-comment-box__cancel arneiron-btn arneiron-btn--ghost" hidden>' . esc_html__( 'Cancel', 'arneiron-lite' ) . '</button> ';
		$submit_field             = isset( $defaults['submit_field'] ) ? (string) $defaults['submit_field'] : '<p class="form-submit">%1$s %2$s</p>';
		$submit_field             = preg_replace( '#class="form-submit#', 'class="form-submit arneiron-comment-box__actions', $submit_field, 1 );
		$defaults['submit_field'] = str_replace( '%1$s', $cancel . '%1$s', $submit_field );
		$defaults['label_submit'] = __( 'Comment', 'arneiron-lite' );
		// "Leave a Reply" follows the post's <h1>: an <h2>, not core's default <h3>
		// (no skipped heading level; it keeps its look through .comment-reply-title).
		if ( isset( $defaults['title_reply_before'] ) && 0 === strpos( (string) $defaults['title_reply_before'], '<h3' ) ) {
			$defaults['title_reply_before'] = '<h2 id="reply-title" class="comment-reply-title">';
			$defaults['title_reply_after']  = '</h2>';
		}
		return $defaults;
	}
}
add_filter( 'comment_form_defaults', 'arneiron_comment_box_defaults', 20 );

if ( ! function_exists( 'arneiron_comment_box_assets' ) ) {
	/**
	 * Enqueue the comment box script and style where a comment form can show.
	 *
	 * @return void
	 */
	function arneiron_comment_box_assets() {
		if ( ! is_singular() || ! comments_open() ) {
			return;
		}
		wp_enqueue_style( 'arneiron-comment-box', ARNEIRON_URI . '/assets/css/comment-box.css', array( 'arneiron-ds' ), arneiron_asset_ver( 'assets/css/comment-box.css' ) );
		wp_enqueue_script(
			'arneiron-comment-box',
			ARNEIRON_URI . '/assets/js/comment-box.js',
			array(),
			arneiron_asset_ver( 'assets/js/comment-box.js' ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'arneiron_comment_box_assets', 20 );
