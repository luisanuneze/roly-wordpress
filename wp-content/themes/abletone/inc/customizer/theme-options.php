<?php
/**
 * Theme Options
 *
 * @package Abletone
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function abletone_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'abletone_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'abletone' ),
		'priority' => 130,
	) );

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_latest_posts_title',
			'default'           => esc_html__( 'News', 'abletone' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Latest Posts Title', 'abletone' ),
			'section'           => 'abletone_theme_options',
		)
	);

	// Layout Options
	$wp_customize->add_section( 'abletone_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'abletone' ),
		'panel' => 'abletone_theme_options',
		)
	);

	/* Default Layout */
	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'abletone_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'abletone' ),
			'section'           => 'abletone_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'abletone' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'abletone' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_homepage_archive_layout',
			'default'           => 'no-sidebar-full-width',
			'sanitize_callback' => 'abletone_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'abletone' ),
			'section'           => 'abletone_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'abletone' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'abletone' ),
			),
		)
	);

	/* Single Page/Post Image */
	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'abletone_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image', 'abletone' ),
			'section'           => 'abletone_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'disabled'              => esc_html__( 'Disabled', 'abletone' ),
				'post-thumbnail'        => esc_html__( 'Post Thumbnail', 'abletone' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'abletone_excerpt_options', array(
		'panel'     => 'abletone_theme_options',
		'title'     => esc_html__( 'Excerpt Options', 'abletone' ),
	) );

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_excerpt_length',
			'default'           => '20',
			'sanitize_callback' => 'absint',
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'abletone' ),
			'section'  => 'abletone_excerpt_options',
			'type'     => 'number',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading...', 'abletone' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'abletone' ),
			'section'           => 'abletone_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'abletone_search_options', array(
		'panel'     => 'abletone_theme_options',
		'title'     => esc_html__( 'Search Options', 'abletone' ),
	) );

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_search_text',
			'default'           => esc_html__( 'Search', 'abletone' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Search Text', 'abletone' ),
			'section'           => 'abletone_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'abletone_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'abletone' ),
		'panel'       => 'abletone_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'abletone' ),
	) );

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'News', 'abletone' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'abletone' ),
			'section'           => 'abletone_homepage_options',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_static_page_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'	=> 'abletone_is_static_page_enabled',
			'default'           => esc_html__( 'Archives', 'abletone' ),
			'label'             => esc_html__( 'Posts Page Header Text', 'abletone' ),
			'section'           => 'abletone_homepage_options',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_front_page_category',
			'sanitize_callback' => 'abletone_sanitize_category_list',
			'custom_control'    => 'Abletone_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'abletone' ),
			'section'           => 'abletone_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	// Pagination Options.
	$pagination_type = get_theme_mod( 'abletone_pagination_type', 'default' );

	$nav_desc = '';

	/**
	* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	*/
	$nav_desc = sprintf(
		wp_kses(
			__( 'For infinite scrolling, use %1$sCatch Infinite Scroll Plugin%2$s with Infinite Scroll module Enabled.', 'abletone' ),
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

	$wp_customize->add_section( 'abletone_pagination_options', array(
		'description'     => $nav_desc,
		'panel'           => 'abletone_theme_options',
		'title'           => esc_html__( 'Pagination Options', 'abletone' ),
		'active_callback' => 'abletone_scroll_plugins_inactive'
	) );

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'abletone_sanitize_select',
			'choices'           => abletone_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'abletone' ),
			'section'           => 'abletone_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'abletone_scrollup', array(
		'panel'    => 'abletone_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'abletone' ),
	) );

	$action = 'install-plugin';
	$slug   = 'to-top';

	$install_url = wp_nonce_url(
	    add_query_arg(
	        array(
	            'action' => $action,
	            'plugin' => $slug
	        ),
	        admin_url( 'update.php' )
	    ),
	    $action . '_' . $slug
	);

	// Add note to Scroll up Section
    abletone_register_option( $wp_customize, array(
            'name'              => 'abletone_to_top_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Abletone_Note_Control',
            'active_callback'   => 'abletone_is_to_top_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Scroll Up, install %1$sTo Top%2$s Plugin', 'abletone' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'abletone_scrollup',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    abletone_register_option( $wp_customize, array(
            'name'              => 'abletone_to_top_option_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Abletone_Note_Control',
            'active_callback'   => 'abletone_is_to_top_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For Scroll Up Options, go %1$shere%2$s', 'abletone'  ),
                 '<a href="javascript:wp.customize.panel( \'to_top_panel\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'abletone_scrollup',
            'type'              => 'description',
        )
    );

	//Footer Background Image.
	$wp_customize->add_section( 'abletone_footer_background', array(
		'panel'     => 'abletone_theme_options',
		'title'     => esc_html__( 'Footer Background Image', 'abletone' ),
	) );

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_footer_bg_image',
			'sanitize_callback' => 'abletone_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Footer Background Image', 'abletone' ),
			'section'           => 'abletone_footer_background',
		)
	);
}
add_action( 'customize_register', 'abletone_theme_options' );


/** Active Callback Functions */
if ( ! function_exists( 'abletone_scroll_plugins_inactive' ) ) :
	/**
	* Return true if infinite scroll functionality exists
	*
	* @since Abletone 0.1
	*/
	function abletone_scroll_plugins_inactive( $control ) {
		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) || class_exists( 'Catch_Infinite_Scroll' ) ) {
			// Support infinite scroll plugins.
			return false;
		}

		return true;
	}
endif;

if ( ! function_exists( 'abletone_is_static_page_enabled' ) ) :
	/**
	* Return true if A Static Page is enabled
	*
	* @since Abletone 1.1.2
	*/
	function abletone_is_static_page_enabled( $control ) {
		$enable = $control->manager->get_setting( 'show_on_front' )->value();
		if ( 'page' === $enable ) {
			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'abletone_is_to_top_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Simclick 0.1
    */
    function abletone_is_to_top_inactive( $control ) {
        return ! ( class_exists( 'To_Top' ) );
    }
endif;

if ( ! function_exists( 'abletone_is_to_top_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Simclick 0.1
    */
    function abletone_is_to_top_active( $control ) {
        return ( class_exists( 'To_Top' ) );
    }
endif;
