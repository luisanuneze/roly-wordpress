<?php
add_filter( 'excerpt_length', 'olsen_light_excerpt_length' );
function olsen_light_excerpt_length( $length ) {
	return get_theme_mod( 'excerpt_length', 55 );
}

add_filter( 'previous_posts_link_attributes', 'olsen_light_previous_posts_link_attributes' );
function olsen_light_previous_posts_link_attributes( $attrs ) {
	$attrs .= ' class="paging-standard paging-older"';
	return $attrs;
}
add_filter( 'next_posts_link_attributes', 'olsen_light_next_posts_link_attributes' );
function olsen_light_next_posts_link_attributes( $attrs ) {
	$attrs .= ' class="paging-standard paging-newer"';
	return $attrs;
}

add_filter( 'wp_page_menu', 'olsen_light_wp_page_menu', 10, 2 );
function olsen_light_wp_page_menu( $menu, $args ) {
	preg_match( '#^<div class="(.*?)">(?:.*?)</div>$#', $menu, $matches );
	$menu = preg_replace( '#^<div class=".*?">#', '', $menu, 1 );
	$menu = preg_replace( '#</div>$#', '', $menu, 1 );
	$menu = preg_replace( '#^<ul>#', '<ul class="' . esc_attr( $args['menu_class'] ) . '">', $menu, 1 );
	return $menu;
}


add_filter( 'the_content', 'olsen_light_lightbox_rel', 12 );
add_filter( 'get_comment_text', 'olsen_light_lightbox_rel' );
add_filter( 'wp_get_attachment_link', 'olsen_light_lightbox_rel' );
if ( ! function_exists( 'olsen_light_lightbox_rel' ) ) :
	function olsen_light_lightbox_rel( $content ) {
		global $post;
		if ( ! is_admin() && ! empty( $post ) ) {
			$pattern     = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
			$replacement = '<a$1href=$2$3.$4$5 data-lightbox="gal[' . $post->ID . ']"$6>$7</a>';
			$content     = preg_replace( $pattern, $replacement, $content );
		}

		return $content;
	}
endif;


add_filter( 'wp_link_pages_args', 'olsen_light_wp_link_pages_args' );
function olsen_light_wp_link_pages_args( $params ) {
	$params = array_merge( $params, array(
		'before' => '<p class="link-pages">' . esc_html__( 'Pages:', 'olsen-light' ),
		'after'  => '</p>',
	) );

	return $params;
}

/* Add .opening custom class in TinyMCE */
add_filter( 'tiny_mce_before_init', 'olsen_light_insert_wp_editor_formats' );
if ( ! function_exists( 'olsen_light_insert_wp_editor_formats' ) ) :
	function olsen_light_insert_wp_editor_formats( $init_array ) {
		// Define the style_formats array
		$style_formats = array(
			// Each array child is a format with it's own settings
			array(
				'title'   => esc_html__( 'Opening Paragraph', 'olsen-light' ),
				'block'   => 'div',
				'classes' => 'opening',
				'wrapper' => true,
			),
		);
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = wp_json_encode( $style_formats );

		return $init_array;
	}
endif;

add_filter( 'mce_buttons_2', 'olsen_light_mce_buttons_2' );
if ( ! function_exists( 'olsen_light_mce_buttons_2' ) ) :
	function olsen_light_mce_buttons_2( $buttons ) {
		array_unshift( $buttons, 'styleselect' );

		return $buttons;
	}
endif;

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
add_action( 'wp_body_open', 'olsen_light_skip_link', 5 );
function olsen_light_skip_link() {
	?><div><a class="skip-link sr-only sr-only-focusable" href="#site-content"><?php esc_html_e( 'Skip to the content', 'olsen-light' ); ?></a></div><?php
}

/**
 * Add wrapper to embedded items to apply responsive styling.
 */
add_filter( 'embed_oembed_html', 'olsen_light_oembed_responsive_wrapper', 10, 4 );
function olsen_light_oembed_responsive_wrapper( $cache, $url, $attr, $post_ID ) {
	if ( empty( $cache ) ) {
		return $cache;
	}

	$url_patterns = array(
		'youtube.com',
		'youtu.be',
		'youtube-nocookie.com', // This doesn't seem to embed anything.
		'vimeo.com',
		'dailymotion.com',
		'dai.ly', // This doesn't seem to embed anything.
		'hulu.com',
		'wordpress.tv',
		'slideshare.net',
	);

	$match = false;

	foreach ( $url_patterns as $url_pattern ) {
		$pattern = 'https?://.*?' . preg_quote( $url_pattern, '#' );
		if ( preg_match( '#' . $pattern . '#', $url ) ) {
			$match = true;
			break;
		}
	}

	if ( $match ) {
		$cache = '<div class="olsen-light-responsive-embed">' . $cache . '</div>';
	}

	return $cache;
}