<?php
/**
 * Section Decor for core/group — the shaped SVG divider.
 *
 * Ported from the reference's Row → "Decor" tab
 * (solutech/vc_templates/vc_maps/vc_add_gradient.php, rendered by vc_row.php:255+).
 * A decor is an SVG POLYGON filled by a LINEAR GRADIENT, sitting immediately above
 * or below the row, which is what produces the angled / curved section transitions.
 *
 * WHY THIS IS SERVER-SIDE. core/group saves statically, and the only save-time hook
 * available to a filter, `blocks.getSaveContent.extraProps`, can add a className or
 * a style and nothing else — it cannot emit child elements. An SVG cannot be faked
 * with ::before/::after either: pseudo-elements cannot draw an arbitrary polygon
 * with a multi-stop gradient. So the markup is injected at render time, which also
 * means an existing Row gains or loses a decor with no block-validation churn and
 * nothing to re-save.
 *
 * @package ArneIronBase
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'arneiron_decor_defaults' ) ) {
	/**
	 * One decor side, with every key present so the renderer never has to guess.
	 *
	 * @return array
	 */
	function arneiron_decor_defaults() {
		return array(
			'show'      => false,
			'height'    => 100,
			'opacity'   => '1',
			'points'    => '',
			'unit'      => 'percent',
			'direction' => 'vertical',
			'offset'    => 0,
			'gradients' => array(),
		);
	}
}

if ( ! function_exists( 'arneiron_decor_svg' ) ) {
	/**
	 * Build one decor band.
	 *
	 * COORDINATES. The reference accepts a space-separated list of `x,y` pairs and
	 * supports two units, which are genuinely different geometries rather than a
	 * simple scale factor:
	 *
	 *   percent  the polygon lives in a 0-100 box painted through an SVG <pattern>
	 *            with preserveAspectRatio="none", so the shape STRETCHES to the row
	 *            width. This is the default and what most dividers want.
	 *   px       the polygon is drawn at true size in a nested <svg> anchored at
	 *            x="50%" with overflow visible, so the shape keeps its aspect ratio
	 *            and is centred, spilling past the row edges rather than stretching.
	 *            The -4000 / 4000 closing points are the reference's way of filling
	 *            that spill.
	 *
	 * Y IS INVERTED FOR THE TOP BAND (`height - y`) and used as-is at the bottom, so
	 * the same point list produces a shape and its mirror.
	 *
	 * @param array  $d    One side's settings.
	 * @param string $side 'top' or 'bottom'.
	 * @param string $uid  Unique suffix for the gradient/pattern ids.
	 * @return string Markup, '' when the side is off or has no points.
	 */
	function arneiron_decor_svg( $d, $side, $uid ) {
		$d = wp_parse_args( is_array( $d ) ? $d : array(), arneiron_decor_defaults() );

		if ( empty( $d['show'] ) || '' === trim( (string) $d['points'] ) ) {
			return '';
		}

		$height  = max( 1, (int) $d['height'] );
		$opacity = '' !== (string) $d['opacity'] ? (string) $d['opacity'] : '1';
		$is_top  = ( 'top' === $side );
		$is_px   = ( 'px' === $d['unit'] );

		/* Direction is expressed as gradient vector endpoints, exactly as the
		   reference does — horizontal sweeps left→right, otherwise top→bottom. */
		$vector = ( 'horizontal' === $d['direction'] )
			? 'x1="0" y1="0" x2="100%" y2="0"'
			: 'x1="0" y1="0" x2="0" y2="100%"';

		$grad_id = 'arneiron-decor-grad-' . $uid . '-' . $side;
		$pat_id  = 'arneiron-decor-pat-' . $uid . '-' . $side;

		/* --- fill: a gradient when stops exist, a flat colour otherwise ------- */
		$stops = array();

		foreach ( (array) $d['gradients'] as $g ) {
			$color = isset( $g['color'] ) && '' !== $g['color'] ? $g['color'] : 'currentColor';
			$off   = isset( $g['offset'] ) && '' !== (string) $g['offset'] ? (string) $g['offset'] : '0';

			if ( false === strpos( $off, '%' ) ) {
				$off .= '%';
			}

			$stops[] = '<stop offset="' . esc_attr( $off ) . '" stop-color="' . esc_attr( $color )
				. '" stop-opacity="' . esc_attr( $opacity ) . '"></stop>';
		}

		$defs = '';
		$fill = 'currentColor';

		if ( $stops ) {
			$defs = '<linearGradient id="' . esc_attr( $grad_id ) . '" ' . $vector . '>'
				. implode( '', $stops ) . '</linearGradient>';
			$fill = 'url(#' . $grad_id . ')';
		}

		/* --- the polygon ------------------------------------------------------ */
		$pairs  = preg_split( '/\s+/', trim( (string) $d['points'] ) );
		$points = '';

		foreach ( $pairs as $pair ) {
			$xy = explode( ',', $pair );

			if ( count( $xy ) < 2 ) {
				continue;
			}

			$x = trim( $xy[0] );
			$y = (float) trim( $xy[1] );

			if ( $is_px ) {
				$y = $is_top ? ( $height - $y ) : $y;
			} else {
				$y = $is_top ? ( 100 - $y ) : $y;
			}

			$points .= $x . ',' . round( $y, 2 ) . ' ';
		}

		if ( '' === trim( $points ) ) {
			return '';
		}

		if ( $is_px ) {
			$close = $is_top ? $height : 0;
			$body  = '<svg x="50%" y="0" width="1" height="100%" overflow="visible" style="overflow:visible">'
				. '<polygon fill="' . esc_attr( $fill ) . '" points="-4000,' . esc_attr( $close ) . ' '
				. esc_attr( trim( $points ) ) . ' 4000,' . esc_attr( $close ) . '"></polygon></svg>';
			$defs  = '<defs>' . $defs . '</defs>';
		} else {
			$close = $is_top ? 100 : 0;
			$defs  = '<defs>' . $defs
				. '<pattern id="' . esc_attr( $pat_id ) . '" preserveAspectRatio="none" patternUnits="userSpaceOnUse"'
				. ' x="0" y="0" width="100%" height="' . esc_attr( $height ) . 'px" viewBox="0 0 100 100">'
				. '<polygon fill="' . esc_attr( $fill ) . '" points="0,' . esc_attr( $close ) . ' '
				. esc_attr( trim( $points ) ) . ' 100,' . esc_attr( $close ) . '"></polygon>'
				. '</pattern></defs>';
			$body  = '<rect x="0" y="0" width="100%" height="' . esc_attr( $height ) . 'px"'
				. ' fill="url(#' . esc_attr( $pat_id ) . ')"></rect>';
		}

		$edge = $is_top ? 'top' : 'bottom';

		/*
		 * The band is pulled OUT of the row by its own height, less 1px.
		 *
		 * That -1 is the reference's, and it is deliberate: at exactly -height the
		 * band and the row meet on a subpixel boundary and a hairline of page
		 * background shows through between them, so it is overlapped by one pixel.
		 *
		 * `offset` moves it further out on top of that — positive lifts a top band
		 * clear of the row (and drops a bottom band), which is what you want when
		 * the shape should sit ABOVE the section rather than bleed onto it. It is a
		 * per-decor setting because the right value depends on the artwork: a
		 * polygon whose points already stop short of the baseline needs none.
		 */
		$pull = $height - 1 + (int) $d['offset'];

		return '<div class="arneiron-decor-wrap ' . esc_attr( $edge ) . '" aria-hidden="true" style="'
			. esc_attr( $edge ) . ':-' . esc_attr( $pull ) . 'px;height:' . esc_attr( $height ) . 'px">'
			. '<svg width="100%" height="' . esc_attr( $height ) . 'px">' . $defs . $body . '</svg></div>';
	}
}

if ( ! function_exists( 'arneiron_decor_render_group' ) ) {
	/**
	 * Inject the decor bands into a core/group that asks for them.
	 *
	 * @param string $content Rendered block HTML.
	 * @param array  $block   Parsed block.
	 * @return string
	 */
	function arneiron_decor_render_group( $content, $block ) {
		if ( empty( $block['blockName'] ) || 'core/group' !== $block['blockName'] ) {
			return $content;
		}

		$attrs = isset( $block['attrs'] ) ? $block['attrs'] : array();
		$top    = isset( $attrs['arneironDecorTop'] ) ? $attrs['arneironDecorTop'] : array();
		$bottom = isset( $attrs['arneironDecorBottom'] ) ? $attrs['arneironDecorBottom'] : array();

		if ( empty( $top['show'] ) && empty( $bottom['show'] ) ) {
			return $content;
		}

		/* Stable per-block id so the gradient/pattern ids are unique on a page that
		   uses several decorated rows. Derived from the attributes rather than
		   rand(), which the reference used — a random id changes on every request
		   and defeats page caching diffs for no benefit. */
		$uid = substr( md5( wp_json_encode( array( $top, $bottom ) ) ), 0, 8 );

		$svg = arneiron_decor_svg( $top, 'top', $uid ) . arneiron_decor_svg( $bottom, 'bottom', $uid );

		if ( '' === $svg ) {
			return $content;
		}

		/* The wrapper needs a positioning context and must not clip the bands. */
		if ( class_exists( 'WP_HTML_Tag_Processor' ) ) {
			$p = new WP_HTML_Tag_Processor( $content );

			if ( $p->next_tag() ) {
				$p->add_class( 'arneiron-has-decor' );
				$content = $p->get_updated_html();
			}
		}

		/* Injected before the wrapper's closing tag. `strrpos` rather than a regex:
		   the group's inner HTML is arbitrary block markup and the last `</div>` of
		   the string IS the wrapper's own, whereas a regex over nested markup would
		   have to guess. If the wrapper is not a div (tagName is settable on a
		   group) the decor is appended instead of injected — still rendered, just
		   after the element, which is why the CSS positions it from the wrapper. */
		$pos = strrpos( $content, '</div>' );

		return ( false === $pos )
			? $content . $svg
			: substr( $content, 0, $pos ) . $svg . substr( $content, $pos );
	}
	add_filter( 'render_block', 'arneiron_decor_render_group', 10, 2 );
}
