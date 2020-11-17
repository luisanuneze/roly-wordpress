<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.me/
 *
 * @package Photo_Journal
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function photo_journal_jetpack_setup() {
	/**
	 * Setup Infinite Scroll using JetPack if navigation type is set
	 */
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'wrapper'        => false,
		'render'         => 'photo_journal_infinite_scroll_render',
		'footer'         => false,
		'footer_widgets' => array( 'sidebar-2', 'sidebar-3', 'sidebar-4' ),
	) );
}
add_action( 'after_setup_theme', 'photo_journal_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function photo_journal_infinite_scroll_render() {
while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content/content', 'search' );
		else :
			get_template_part( 'template-parts/content/content', get_post_format() );
		endif;
	}
}

/**
 * Support JetPack featured content
 */
function photo_journal_get_featured_posts() {
	$type = 'featured-content';

	if ( 'tag' === $type ) {
		return apply_filters( 'photo_journal_get_featured_posts', false );
	}

	$number = get_theme_mod( 'photo_journal_featured_content_number', 3 );

	$post_list    = array();

	$args = array(
		'posts_per_page'      => $number,
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	// Get valid number of posts.
	if ( 'post' === $type || 'page' === $type || 'featured-content' === $type ) {
		$args['post_type'] = $type;

		for ( $i = 1; $i <= $number; $i++ ) {
			$post_id = '';

			if ( 'post' === $type ) {
				$post_id = get_theme_mod( 'photo_journal_featured_content_post_' . $i );
			} elseif ( 'page' === $type ) {
				$post_id = get_theme_mod( 'photo_journal_featured_content_page_' . $i );
			} elseif ( 'featured-content' === $type ) {
				$post_id = get_theme_mod( 'photo_journal_featured_content_cpt_' . $i );
			}

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );
			}
		}

		$args['post__in'] = $post_list;
		$args['orderby']  = 'post__in';
	} elseif ( 'category' === $type && $cat = get_theme_mod( 'photo_journal_featured_content_select_category' ) ) {
		$args['category__in'] = $cat;
	}

	$featured_posts = get_posts( $args );

	return $featured_posts;
}
