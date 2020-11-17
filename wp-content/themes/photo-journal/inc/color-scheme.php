<?php
/**
 * Customizer functionality
 *
 * @package Photo_Journal
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Photo Journal 0.1
 *
 * @see photo_journal_header_style()
 */
function photo_journal_custom_header_and_background() {
	$default_background_color = '#000000';
	$default_text_color       = '#ffffff';

	/**
	 * Filter the arguments used when adding 'custom-background' support in Persona.
	 *
	 * @since Photo Journal 0.1
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'photo_journal_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Persona.
	 *
	 * @since Photo Journal 0.1
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
	add_theme_support( 'custom-header', apply_filters( 'photo_journal_custom_header_args', array(
		'default-image'      	 => get_parent_theme_file_uri( '/assets/images/header-image.jpg' ),
		'default-text-color'     => $default_text_color,
		'width'                  => 1920,
		'height'                 => 1080,
		'flex-height'            => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'photo_journal_header_style',
		'video'                  => true,
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header-image.jpg',
			'thumbnail_url' => '%s/assets/images/header-image-275x155.jpg',
			'description'   => esc_html__( 'Default Header Image', 'photo-journal' ),
		),
	) );
}
add_action( 'after_setup_theme', 'photo_journal_custom_header_and_background' );

if ( ! function_exists( 'photo_journal_header_style' ) ) :
	/**
	 * Styles the header text displayed on the site.
	 *
	 * Create your own photo_journal_header_style() function to override in a child theme.
	 *
	 * @since Photo Journal 0.1
	 *
	 * @see photo_journal_custom_header_and_background().
	 */
	function photo_journal_header_style() {
	// If the header text has been hidden.
	?>
	<?php
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		$header_text_color = get_header_textcolor();
		$default_color     = '#ffffff';

		if ( $default_color !== $header_text_color ) :
		?>
		<style type="text/css" id="photo-journal-header-css">
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
		</style>
	<?php
		endif;
	} else {
		?>
		<style type="text/css" id="photo-journal-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}

		.site-identity {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
		</style>
	<?php
	}
}
endif; // photo_journal_header_style

/**
 * Customize video play/pause button in the custom header.
 *
 * @param array $settings header video settings.
 */
function photo_journal_video_controls( $settings ) {
	$settings['l10n']['play'] = '<span class="screen-reader-text">' . esc_html__( 'Play background video', 'photo-journal' ) . '</span>' . photo_journal_get_svg( array(
		'icon' => 'play',
	) );
	$settings['l10n']['pause'] = '<span class="screen-reader-text">' . esc_html__( 'Pause background video', 'photo-journal' ) . '</span>' . photo_journal_get_svg( array(
		'icon' => 'pause',
	) );

	return $settings;
}
add_filter( 'header_video_settings', 'photo_journal_video_controls' );

/**
 * @since Photo Journal 0.1
 */
function photo_journal_customize_control_js() {
	wp_enqueue_style( 'photo-journal-custom-controls-css', trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'photo_journal_customize_control_js' );
