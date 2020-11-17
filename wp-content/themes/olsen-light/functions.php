<?php
add_action( 'after_setup_theme', 'olsen_light_setup' );
if( !function_exists( 'olsen_light_setup' ) ) :
	function olsen_light_setup() {

		$GLOBALS['content_width'] = apply_filters( 'olsen_light_content_width', 665 );

		if ( ! defined( 'OLSEN_LIGHT_NAME' ) ) {
			define( 'OLSEN_LIGHT_NAME', 'olsen-light' );
		}

		load_theme_textdomain( 'olsen-light', get_template_directory() . '/languages' );

		/*
		 * Theme supports.
		 */
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'css/admin/editor-styles.min.css' );

		/*
		 * Image sizes.
		 */
		set_post_thumbnail_size( 720, 471, true );
		add_image_size( 'ci_slider', 1110, 600, true );
		add_image_size( 'olsen_light_square', 200, 200, true );

		/*
		 * Navigation menus.
		 */
		register_nav_menus( array(
			'main_menu'   => esc_html__( 'Main Menu', 'olsen-light' ),
			'top_menu'    => esc_html__( 'Top Menu', 'olsen-light' ),
			'footer_menu' => esc_html__( 'Footer Menu', 'olsen-light' ),
			'mobile_menu' => esc_html__( 'Mobile Menu', 'olsen-light' ),
		) );

		/*
		 * Default hooks
		 */
		// Prints the inline JS scripts that are registered for printing, and removes them from the queue.
		add_action( 'admin_footer', 'olsen_light_print_inline_js' );
		add_action( 'wp_footer', 'olsen_light_print_inline_js' );

		// Wraps post counts in span.ci-count
		// Needed for the default widgets, however more appropriate filters don't exist.
		add_filter( 'get_archives_link', 'olsen_light_wrap_archive_widget_post_counts_in_span', 10, 2 );
		add_filter( 'wp_list_categories', 'olsen_light_wrap_category_widget_post_counts_in_span', 10, 2 );
	}
endif;

/**
 *  Theme helper functions.
 */
require_once get_theme_file_path( '/inc/helpers.php' );

/**
 *  Post meta related functions.
 */
require_once get_theme_file_path( '/inc/post-meta/helpers-post-meta.php' );

/**
 *  Sanitization functions.
 */
require_once get_theme_file_path( '/inc/sanitization.php' );

/**
 *  Default hooks.
 */
require_once get_theme_file_path( '/inc/default-hooks.php' );

/**
 *  Layout related functions.
 */
require_once get_theme_file_path( '/inc/layout.php' );

/**
 *  Theme scripts and styles.
 */
require_once get_theme_file_path( '/inc/scripts-styles.php' );

/**
 *  Customizer functions.
 */
require_once get_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Sidebars and widgets.
 */
require_once get_theme_file_path( '/inc/sidebars-widgets.php' );

/**
 * User onboarding.
 */
require_once get_theme_file_path( '/inc/onboarding.php' );
