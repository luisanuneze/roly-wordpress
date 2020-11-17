<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package JetBlack
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function jetblack_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'infinite-grid',
		'render'    => 'jetblack_infinite_scroll_render',
		'footer'    => 'page',
		'wrapper'   => false,
	) );
}
add_action( 'after_setup_theme', 'jetblack_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function jetblack_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content/content', 'search' );
		else :
			get_template_part( 'template-parts/content/content', get_post_type() );
		endif;
	}
}
