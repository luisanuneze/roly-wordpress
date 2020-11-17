<?php
/**
 * Customizer functionality
 *
 * @package Abletone
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Abletone 0.1
 *
 * @see abletone_header_style()
 */
function abletone_custom_header_and_background() {
	$default_background_color = '#ffffff';
	$default_text_color       = '#03065d';

	/**
	 * Filter the arguments used when adding 'custom-background' support in Abletone.
	 *
	 * @since Abletone 0.1
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'abletone_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Abletone.
	 *
	 * @since Abletone 0.1
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'abletone_custom_header_args', array(
		'default-image'      	 => get_parent_theme_file_uri( '/assets/images/header-image.jpg' ),
		'default-text-color'     => $default_text_color,
		'width'                  => 1920,
		'height'                 => 1080,
		'flex-height'            => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'abletone_header_style',
		'video'                  => true,
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header-image.jpg',
			'thumbnail_url' => '%s/assets/images/header-image-275x155.jpg',
			'description'   => esc_html__( 'Default Header Image', 'abletone' ),
		),
		'second-image' => array(
			'url'           => '%s/assets/images/header-image.jpg',
			'thumbnail_url' => '%s/assets/images/header-image-275x155.jpg',
			'description'   => esc_html__( 'Alternate Header Image', 'abletone' ),
		),
	) );
}
add_action( 'after_setup_theme', 'abletone_custom_header_and_background' );

/**
 * Customize video play/pause button in the custom header.
 *
 * @param array $settings header video settings.
 */
function abletone_video_controls( $settings ) {
	$settings['l10n']['play'] = '<span class="screen-reader-text">' . esc_html__( 'Play background video', 'abletone' ) . '</span>';
	$settings['l10n']['pause'] = '<span class="screen-reader-text">' . esc_html__( 'Pause background video', 'abletone' ) . '</span>';
	return $settings;
}
add_filter( 'header_video_settings', 'abletone_video_controls' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Abletone 1.0
 * @see abletone_customize_register()
 *
 * @return void
 */
function abletone_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 *
 * @since Abletone 0.1
 */
function abletone_customize_control_js() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	$path = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'assets/js/source/' : 'assets/js/';

	wp_enqueue_style( 'abletone-custom-controls-css', trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/css/customizer.css' );

}
add_action( 'customize_controls_enqueue_scripts', 'abletone_customize_control_js' );