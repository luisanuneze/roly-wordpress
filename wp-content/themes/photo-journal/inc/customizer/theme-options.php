<?php
/**
 * Theme Options
 *
 * @package Photo_Journal
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photo_journal_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'photo_journal_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'photo-journal' ),
		'priority' => 130,
	) );

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_latest_posts_title',
			'default'           => esc_html__( 'News', 'photo-journal' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Latest Posts Title', 'photo-journal' ),
			'section'           => 'photo_journal_theme_options',
		)
	);

	// Layout Options
	$wp_customize->add_section( 'photo_journal_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'photo-journal' ),
		'panel' => 'photo_journal_theme_options',
		)
	);

	/* Default Layout */
	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'photo_journal_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'photo-journal' ),
			'section'           => 'photo_journal_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'photo-journal' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'photo-journal' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_homepage_archive_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'photo_journal_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'photo-journal' ),
			'section'           => 'photo_journal_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'photo-journal' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'photo-journal' ),
			),
		)
	);

	/* Single Page/Post Image Layout */
	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'photo_journal_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image Layout', 'photo-journal' ),
			'section'           => 'photo_journal_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'disabled'              => esc_html__( 'Disabled', 'photo-journal' ),
				'post-thumbnail'        => esc_html__( 'Post Thumbnail', 'photo-journal' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'photo_journal_excerpt_options', array(
		'panel'     => 'photo_journal_theme_options',
		'title'     => esc_html__( 'Excerpt Options', 'photo-journal' ),
	) );

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_excerpt_length',
			'default'           => '20',
			'sanitize_callback' => 'absint',
			'description' => esc_html__( 'Excerpt length. Default is 20 words', 'photo-journal' ),
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'photo-journal' ),
			'section'  => 'photo_journal_excerpt_options',
			'type'     => 'number',
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_excerpt_more_text',
			'default'           => esc_html__( 'Continue Reading', 'photo-journal' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Continue Reading Text', 'photo-journal' ),
			'section'           => 'photo_journal_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'photo_journal_search_options', array(
		'panel'     => 'photo_journal_theme_options',
		'title'     => esc_html__( 'Search Options', 'photo-journal' ),
	) );

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_search_text',
			'default'           => esc_html__( 'Search', 'photo-journal' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Search Text', 'photo-journal' ),
			'section'           => 'photo_journal_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'photo_journal_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'photo-journal' ),
		'panel'       => 'photo_journal_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'photo-journal' ),
	) );

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_front_page_category',
			'sanitize_callback' => 'photo_journal_sanitize_category_list',
			'custom_control'    => 'Photo_Journal_Multi_Categories_Control',
			'label'             => esc_html__( 'Categories', 'photo-journal' ),
			'section'           => 'photo_journal_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'Recent Posts', 'photo-journal' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'photo-journal' ),
			'section'           => 'photo_journal_homepage_options',
		)
	);

	// Pagination Options.
	$pagination_type = get_theme_mod( 'photo_journal_pagination_type', 'default' );

	$nav_desc = '';

	/**
	* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	*/
	$nav_desc = sprintf(
		wp_kses(
			__( 'For infinite scrolling, use %1$sCatch Infinite Scroll Plugin%2$s with Infinite Scroll module Enabled.', 'photo-journal' ),
			array(
				'a' => array(
					'href' => array(),
					'target' => array(),
				),
				'br'=> array()
			)
		),
		'<a target="_blank" href="https://wordpress.org/plugins/catch-infinite-scroll/">',
		'</a>'
	);

	$wp_customize->add_section( 'photo_journal_pagination_options', array(
		'description' => $nav_desc,
		'panel'       => 'photo_journal_theme_options',
		'title'       => esc_html__( 'Pagination Options', 'photo-journal' ),
	) );

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'photo_journal_sanitize_select',
			'choices'           => photo_journal_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'photo-journal' ),
			'section'           => 'photo_journal_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'photo_journal_scrollup', array(
		'panel'    => 'photo_journal_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'photo-journal' ),
	) );

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_display_scrollup',
			'default'			=> 1,
			'sanitize_callback' => 'photo_journal_sanitize_checkbox',
			'label'             => esc_html__( 'Scroll Up', 'photo-journal' ),
			'section'           => 'photo_journal_scrollup',
			'custom_control'	=> 'Photo_Journal_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'photo_journal_theme_options' );
