<?php
/**
 * Video in posts: plays when it comes into view, and nothing is cropped.
 *
 * The site's posts carry video in three shapes, and before this module all
 * three looked like a still picture the reader had to find a control on:
 *
 *   1. core/video — `<video controls muted playsinline preload="metadata">`.
 *      A first frame with a play button. It never started by itself.
 *   2. core/embed (YouTube, incl. Shorts) — an iframe thumbnail. The reader had
 *      to click it, and the embed had no JS API, so nothing could start it.
 *   3. the featured image, when the attachment behind it is a video, or when a
 *      poster image names its video in `_arneiron_featured_video`. core renders
 *      `wp_get_attachment_image()`, which has nothing to show for a video.
 *
 * What this module does:
 *   - marks every one of those three with `data-arneiron-autoplay`, and adds
 *     `loop` (and, for YouTube, `enablejsapi=1&mute=1&playsinline=1&loop=1`) so
 *     it CAN be started muted without a gesture;
 *   - assets/js/media-video.js starts it on scroll-in and pauses it on
 *     scroll-out, honours `prefers-reduced-motion: reduce` by not autoplaying
 *     at all, and leaves the player's own controls in place either way;
 *   - renders a real `<video>` plus a visible play/pause control for a featured
 *     image that is a video, so the behaviour is never invisible;
 *   - takes `object-fit: cover` off every core/post-featured-image, so a
 *     featured image keeps its own aspect ratio instead of being cut to the
 *     block's box (assets/css/scroll-story.css drops the matching fixed height
 *     on the single-post featured image, and assets/css/media-video.css keeps
 *     in-content video at its natural ratio).
 *
 * Kill switch: `?arneiron_video=0` on any URL, or the
 * `arneiron_video_autoplay_enabled` filter.
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'arneiron_video_autoplay_enabled' ) ) {
	/**
	 * Whether the scroll-in autoplay layer is active for this request.
	 *
	 * @return bool
	 */
	function arneiron_video_autoplay_enabled() {
		$on = true;
		if ( isset( $_GET['arneiron_video'] ) && '0' === sanitize_key( wp_unslash( $_GET['arneiron_video'] ) ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$on = false;
		}
		/**
		 * Filters whether video autoplay-on-scroll is active.
		 *
		 * @param bool $on Enabled.
		 */
		return (bool) apply_filters( 'arneiron_video_autoplay_enabled', $on );
	}
}

if ( ! function_exists( 'arneiron_media_video_assets' ) ) {
	/**
	 * The module's stylesheet and script. The stylesheet carries the
	 * never-crop rules and always loads; the script only loads when the
	 * autoplay layer is active.
	 *
	 * @return void
	 */
	function arneiron_media_video_assets() {
		if ( is_admin() ) {
			return;
		}
		wp_enqueue_style(
			'arneiron-media-video',
			ARNEIRON_URI . '/assets/css/media-video.css',
			array( 'arneiron-ds' ),
			arneiron_asset_ver( 'assets/css/media-video.css' )
		);
		if ( ! arneiron_video_autoplay_enabled() ) {
			return;
		}
		wp_enqueue_script(
			'arneiron-media-video',
			ARNEIRON_URI . '/assets/js/media-video.js',
			array(),
			arneiron_asset_ver( 'assets/js/media-video.js' ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
		wp_localize_script(
			'arneiron-media-video',
			'arneironMediaVideo',
			array(
				'play'  => __( 'Play video', 'arneiron-lite' ),
				'pause' => __( 'Pause video', 'arneiron-lite' ),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'arneiron_media_video_assets', 20 );

if ( ! function_exists( 'arneiron_video_block_autoplay' ) ) {
	/**
	 * core/video: mark it for scroll-in autoplay and make it loop.
	 *
	 * `muted` and `playsinline` are what let a browser start a video without a
	 * gesture, so they are asserted here rather than assumed from the saved
	 * block. `controls` is never removed: the reader keeps a way to stop it.
	 * A block that already asked for `autoplay` is left alone — the author
	 * meant it, and the script's observer would only fight it.
	 *
	 * @param string $html  Rendered block.
	 * @param array  $block Parsed block.
	 * @return string
	 */
	function arneiron_video_block_autoplay( $html, $block = array() ) {
		unset( $block );
		if ( ! arneiron_video_autoplay_enabled() || false === strpos( $html, '<video' ) ) {
			return $html;
		}
		$p = new WP_HTML_Tag_Processor( $html );
		while ( $p->next_tag( 'video' ) ) {
			if ( null !== $p->get_attribute( 'autoplay' ) ) {
				continue;
			}
			$p->set_attribute( 'muted', true );
			$p->set_attribute( 'playsinline', true );
			$p->set_attribute( 'loop', true );
			$p->set_attribute( 'preload', 'metadata' );
			$p->set_attribute( 'data-arneiron-autoplay', '1' );
		}
		return $p->get_updated_html();
	}
}
add_filter( 'render_block_core/video', 'arneiron_video_block_autoplay', 10, 2 );

if ( ! function_exists( 'arneiron_video_block_ratio' ) ) {
	/**
	 * core/video: tell the stylesheet this video's shape.
	 *
	 * assets/css/media-video.css sizes a video to the largest box of ITS OWN
	 * ratio that fits both the column and the screen, so the ratio has to be
	 * known before the file's metadata arrives (or the box jumps, and a
	 * portrait clip is laid out as 16:9 until then). It is stamped as
	 * `--arneiron-video-ar: W / H` from, in order: the `aspect-ratio` core
	 * already writes inline, the `width`/`height` attributes, the attachment's
	 * metadata. Nothing known ⇒ nothing stamped; the script sets it on
	 * `loadedmetadata`, and the CSS caps the height meanwhile.
	 *
	 * This is layout, not autoplay, so it runs with the kill switch on too.
	 *
	 * @param string $html  Rendered block.
	 * @param array  $block Parsed block.
	 * @return string
	 */
	function arneiron_video_block_ratio( $html, $block = array() ) {
		if ( false === strpos( $html, '<video' ) ) {
			return $html;
		}
		$p = new WP_HTML_Tag_Processor( $html );
		while ( $p->next_tag( 'video' ) ) {
			$style = (string) $p->get_attribute( 'style' );
			if ( false !== strpos( $style, '--arneiron-video-ar' ) ) {
				continue;
			}
			$w = 0;
			$h = 0;
			if ( preg_match( '#aspect-ratio\s*:\s*(\d+(?:\.\d+)?)\s*/\s*(\d+(?:\.\d+)?)#', $style, $m ) ) {
				$w = (float) $m[1];
				$h = (float) $m[2];
			} elseif ( (int) $p->get_attribute( 'width' ) > 0 && (int) $p->get_attribute( 'height' ) > 0 ) {
				$w = (int) $p->get_attribute( 'width' );
				$h = (int) $p->get_attribute( 'height' );
			} elseif ( ! empty( $block['attrs']['id'] ) ) {
				$meta = wp_get_attachment_metadata( (int) $block['attrs']['id'] );
				if ( is_array( $meta ) && ! empty( $meta['width'] ) && ! empty( $meta['height'] ) ) {
					$w = (int) $meta['width'];
					$h = (int) $meta['height'];
				}
			}
			if ( $w <= 0 || $h <= 0 ) {
				continue;
			}
			$decl = sprintf( '--arneiron-video-ar:%s / %s;', $w + 0, $h + 0 );
			$style = trim( $style );
			if ( '' !== $style && ';' !== substr( $style, -1 ) ) {
				$style .= ';';
			}
			$p->set_attribute( 'style', $style . $decl );
		}
		return $p->get_updated_html();
	}
}
add_filter( 'render_block_core/video', 'arneiron_video_block_ratio', 11, 2 );

if ( ! function_exists( 'arneiron_video_youtube_id' ) ) {
	/**
	 * The video id inside a YouTube embed/watch/short URL, or ''.
	 *
	 * @param string $url URL.
	 * @return string
	 */
	function arneiron_video_youtube_id( $url ) {
		if ( preg_match( '#(?:youtube(?:-nocookie)?\.com/(?:embed|shorts|v)/|youtu\.be/)([A-Za-z0-9_-]{6,})#', (string) $url, $m ) ) {
			return $m[1];
		}
		if ( preg_match( '#[?&]v=([A-Za-z0-9_-]{6,})#', (string) $url, $m ) ) {
			return $m[1];
		}
		return '';
	}
}

if ( ! function_exists( 'arneiron_video_site_origin' ) ) {
	/**
	 * This site's origin — scheme://host[:port], no path, no language segment.
	 *
	 * @return string
	 */
	function arneiron_video_site_origin() {
		$parts  = wp_parse_url( home_url() );
		$scheme = isset( $parts['scheme'] ) ? $parts['scheme'] : 'https';
		$host   = isset( $parts['host'] ) ? $parts['host'] : '';
		if ( '' === $host ) {
			return '';
		}
		$port = isset( $parts['port'] ) ? ':' . (int) $parts['port'] : '';
		return $scheme . '://' . $host . $port;
	}
}

if ( ! function_exists( 'arneiron_video_embed_autoplay' ) ) {
	/**
	 * A YouTube iframe cannot be started from the page unless its src says so.
	 * Add `enablejsapi=1` (the postMessage API the script uses), `mute=1` and
	 * `playsinline=1` (what browsers require of an unprompted start), and
	 * `loop=1&playlist=<id>` — YouTube only loops a single video when that
	 * video is also the playlist. `origin` is set so the API accepts us.
	 *
	 * Only YouTube is touched. Any other provider's iframe is returned as it
	 * came: there is no cross-provider way to start one, and guessing at it
	 * would mean shipping a player we do not control.
	 *
	 * @param string $html Embed HTML.
	 * @return string
	 */
	function arneiron_video_embed_autoplay( $html ) {
		if ( ! arneiron_video_autoplay_enabled() || false === stripos( (string) $html, '<iframe' ) ) {
			return (string) $html;
		}
		$p       = new WP_HTML_Tag_Processor( (string) $html );
		$touched = false;
		while ( $p->next_tag( 'iframe' ) ) {
			$src = (string) $p->get_attribute( 'src' );
			$id  = arneiron_video_youtube_id( $src );
			if ( '' === $id || false === stripos( $src, 'youtube' ) ) {
				continue;
			}
			$parts = wp_parse_url( $src );
			$args  = array();
			if ( isset( $parts['query'] ) ) {
				wp_parse_str( $parts['query'], $args );
			}
			$args = array_merge(
				$args,
				array(
					'enablejsapi' => '1',
					'mute'        => '1',
					'playsinline' => '1',
					'loop'        => '1',
					'playlist'    => $id,
					'rel'         => '0',
					/*
					 * A bare scheme://host. Under Polylang `home_url()` is the
					 * LANGUAGE home (…/de), and a postMessage origin carrying a
					 * path is not an origin — YouTube would drop every command
					 * and the embed would never start on a translated post.
					 */
					'origin'      => arneiron_video_site_origin(),
				)
			);
			$base = ( isset( $parts['scheme'] ) ? $parts['scheme'] : 'https' ) . '://'
				. ( isset( $parts['host'] ) ? $parts['host'] : 'www.youtube.com' )
				. ( isset( $parts['path'] ) ? $parts['path'] : '' );
			$p->set_attribute( 'src', esc_url_raw( add_query_arg( $args, $base ) ) );
			$p->set_attribute( 'data-arneiron-autoplay', '1' );
			$p->set_attribute( 'data-arneiron-video-id', $id );
			$touched = true;
		}
		return $touched ? $p->get_updated_html() : (string) $html;
	}
}
add_filter( 'embed_oembed_html', 'arneiron_video_embed_autoplay', 20 );
add_filter( 'render_block_core/embed', 'arneiron_video_embed_autoplay', 20 );

if ( ! function_exists( 'arneiron_featured_video_src' ) ) {
	/**
	 * The video a post's featured image stands for, or ''.
	 *
	 * Two shapes, in order:
	 *   1. the featured attachment IS a video — then it is the video, and core
	 *      had nothing to render for it;
	 *   2. `_arneiron_featured_video` names a video (attachment id or URL) for
	 *      which the featured image is the poster. This is the shape a
	 *      still-frame featured image uses, and it is explicit on purpose: a
	 *      post whose body merely contains a video keeps a plain featured
	 *      image, because guessing would stamp a player on every such post.
	 *
	 * @param int $post_id Post.
	 * @return array{src:string,poster:string,mime:string} Empty src when none.
	 */
	function arneiron_featured_video_src( $post_id ) {
		$none = array(
			'src'    => '',
			'poster' => '',
			'mime'   => '',
		);
		$post_id = (int) $post_id;
		if ( ! $post_id ) {
			return $none;
		}
		$thumb = (int) get_post_thumbnail_id( $post_id );
		if ( $thumb && 0 === strpos( (string) get_post_mime_type( $thumb ), 'video/' ) ) {
			return array(
				'src'    => (string) wp_get_attachment_url( $thumb ),
				'poster' => (string) get_post_meta( $thumb, '_thumbnail_id', true )
					? (string) wp_get_attachment_image_url( (int) get_post_meta( $thumb, '_thumbnail_id', true ), 'large' )
					: '',
				'mime'   => (string) get_post_mime_type( $thumb ),
			);
		}
		$ref = get_post_meta( $post_id, '_arneiron_featured_video', true );
		if ( ! $ref ) {
			return $none;
		}
		$src  = is_numeric( $ref ) ? (string) wp_get_attachment_url( (int) $ref ) : (string) $ref;
		$mime = is_numeric( $ref ) ? (string) get_post_mime_type( (int) $ref ) : '';
		if ( '' === $src ) {
			return $none;
		}
		if ( '' === $mime ) {
			$ext  = strtolower( (string) pathinfo( wp_parse_url( $src, PHP_URL_PATH ), PATHINFO_EXTENSION ) );
			$mime = in_array( $ext, array( 'mp4', 'webm', 'ogv', 'mov' ), true ) ? 'video/' . ( 'mov' === $ext ? 'mp4' : $ext ) : '';
		}
		if ( 0 !== strpos( $mime, 'video/' ) ) {
			return $none;
		}
		return array(
			'src'    => $src,
			'poster' => $thumb ? (string) wp_get_attachment_image_url( $thumb, 'full' ) : '',
			'mime'   => $mime,
		);
	}
}

if ( ! function_exists( 'arneiron_featured_video_html' ) ) {
	/**
	 * Replace a post's featured image with the video it stands for: a looping,
	 * muted `<video>` that the script starts on scroll-in, plus a visible
	 * play/pause button so the reader is never left guessing — that button is
	 * the "navigation to the video" for anyone who has autoplay off, reduced
	 * motion on, or simply wants it stopped.
	 *
	 * The poster keeps the block's own `<img>` sizing contract by inheriting the
	 * same classes, so the layout is unchanged.
	 *
	 * @param string       $html    Featured-image HTML from core.
	 * @param int          $post_id Post.
	 * @param int          $thumb   Attachment id.
	 * @param string|int[] $size    Requested size.
	 * @param string|array $attr    Requested attributes.
	 * @return string
	 */
	function arneiron_featured_video_html( $html, $post_id, $thumb = 0, $size = '', $attr = '' ) {
		unset( $thumb, $size, $attr );
		$video = arneiron_featured_video_src( $post_id );
		if ( '' === $video['src'] ) {
			return $html;
		}
		$autoplay = arneiron_video_autoplay_enabled();
		$label    = esc_attr__( 'Play video', 'arneiron-lite' );
		return sprintf(
			'<span class="arneiron-feat-video" data-arneiron-feat-video="1">'
				. '<video class="arneiron-feat-video__media attachment-post-thumbnail size-post-thumbnail wp-post-image"'
				. ' src="%1$s"%2$s controls muted loop playsinline preload="metadata"%3$s></video>'
				. '<button type="button" class="arneiron-feat-video__btn" aria-label="%4$s">'
				. '<svg class="arneiron-feat-video__icon" width="22" height="22" viewBox="0 0 22 22" aria-hidden="true" focusable="false">'
				. '<path d="M7 4.5v13l11-6.5z" fill="currentColor"/></svg>'
				. '</button></span>',
			esc_url( $video['src'] ),
			'' !== $video['poster'] ? ' poster="' . esc_url( $video['poster'] ) . '"' : '',
			$autoplay ? ' data-arneiron-autoplay="1"' : '',
			$label
		);
	}
}
add_filter( 'post_thumbnail_html', 'arneiron_featured_video_html', 10, 5 );

if ( ! function_exists( 'arneiron_featured_image_no_crop' ) ) {
	/**
	 * Never crop a featured image.
	 *
	 * core/post-featured-image writes `object-fit:cover` inline whenever the
	 * block has an aspect ratio or a height, which cuts the sides (or the top
	 * and bottom) off the author's picture. An inline style cannot be overridden
	 * from a stylesheet without `!important`, and the templates that set the
	 * ratio may also be a site's own saved templates — so the honest place to
	 * fix it is the rendered block: the box the layout wants is kept, and the
	 * picture is fitted inside it whole.
	 *
	 * @param string $html Rendered block.
	 * @return string
	 */
	function arneiron_featured_image_no_crop( $html ) {
		if ( false === strpos( (string) $html, 'object-fit' ) ) {
			return (string) $html;
		}
		$p = new WP_HTML_Tag_Processor( (string) $html );
		while ( $p->next_tag( 'img' ) ) {
			$style = (string) $p->get_attribute( 'style' );
			if ( false === strpos( $style, 'object-fit' ) ) {
				continue;
			}
			$style = preg_replace( '/object-fit\s*:\s*[a-z-]+\s*;?/i', '', $style );
			$style = trim( (string) $style );
			$p->set_attribute( 'style', rtrim( $style, ';' ) . ( '' !== $style ? ';' : '' ) . 'object-fit:contain;' );
			$p->add_class( 'arneiron-no-crop' );
		}
		return $p->get_updated_html();
	}
}
add_filter( 'render_block_core/post-featured-image', 'arneiron_featured_image_no_crop', 20 );
