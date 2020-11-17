<?php
/**
 * Theme Customizer
 *
 * @package Photo_Journal
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photo_journal_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'photo_journal_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'photo_journal_customize_partial_blogdescription',
		) );
	}

	// Important Links.
	$wp_customize->add_section( 'photo_journal_important_links', array(
		'priority'      => 999,
		'title'         => esc_html__( 'Important Links', 'photo-journal' ),
	) );

	// Has dummy Sanitizaition function as it contains no value to be sanitized.
	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_important_links',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Photo_Journal_Important_Links_Control',
			'label'             => esc_html__( 'Important Links', 'photo-journal' ),
			'section'           => 'photo_journal_important_links',
			'type'              => 'photo_journal_important_links',
		)
	);
	// Important Links End.
}
add_action( 'customize_register', 'photo_journal_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function photo_journal_customize_preview_js() {
	wp_enqueue_script( 'photo-journal-customize-preview', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/customize-preview.min.js', array( 'customize-preview' ), '20170816', true );
}
add_action( 'customize_preview_init', 'photo_journal_customize_preview_js' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Photo Journal 0.1
 * @see photo_journal_customize_register()
 *
 * @return void
 */
function photo_journal_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Photo Journal 0.1
 * @see photo_journal_customize_register()
 *
 * @return void
 */
function photo_journal_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Include Custom Controls
 */
require get_parent_theme_file_path( 'inc/customizer/custom-controls.php' );

/**
 * Include Header Media Options
 */
require get_parent_theme_file_path( 'inc/customizer/header-media.php' );

/**
 * Include Theme Options
 */
require get_parent_theme_file_path( 'inc/customizer/theme-options.php' );

/**
 * Include Hero Content
 */
require get_parent_theme_file_path( 'inc/customizer/hero-content.php' );

/**
 * Include Featured Slider
 */
require get_parent_theme_file_path( 'inc/customizer/featured-slider.php' );

/**
 * Include Featured Content
 */
require get_parent_theme_file_path( 'inc/customizer/featured-content.php' );

/**
 * Include Customizer Helper Functions
 */
require get_parent_theme_file_path( 'inc/customizer/helpers.php' );

/**
 * Include Sanitization functions
 */
require get_parent_theme_file_path( 'inc/customizer/sanitize-functions.php' );

/**
 * Include Portfolio
 */
require get_parent_theme_file_path( 'inc/customizer/portfolio.php' );

/**
 * Include Services
 */
require get_parent_theme_file_path( 'inc/customizer/service.php' );

/**
 * Include Testimonials
 */
require get_parent_theme_file_path( 'inc/customizer/testimonial.php' );

/**
 * Include Reset Button
 */
require get_parent_theme_file_path( 'inc/customizer/reset.php' );

/**
 * Include Upgrade Button
 */
require get_parent_theme_file_path( 'inc/customizer/upgrade-button/class-customize.php' );
