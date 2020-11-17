<?php
/**
 * Adds the header options sections, settings, and controls to the theme customizer
 *
 * @package JetBlack
 */

class JetBlack_Header_Options {
	public function __construct() {
		// Register Header Options.
		add_action( 'customize_register', array( $this, 'register_header_options' ) );
	}

	/**
	 * Add header options section and its controls
	 */
	public function register_header_options( $wp_customize ) {
		// Add header options section.
		$wp_customize->add_section( 'jetblack_header_options',
			array(
				'title' => esc_html__( 'Header Options', 'jetblack' ),
				'panel' => 'jetblack_theme_options'
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'jetblack_header_email',
				'sanitize_callback' => 'sanitize_email',
				'label'             => esc_html__( 'Email', 'jetblack' ),
				'section'           => 'jetblack_header_options',
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'jetblack_header_phone',
				'sanitize_callback' => 'jetblack_text_sanitization',
				'label'             => esc_html__( 'Phone', 'jetblack' ),
				'section'           => 'jetblack_header_options',
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'jetblack_header_address',
				'sanitize_callback' => 'jetblack_text_sanitization',
				'label'             => esc_html__( 'Address', 'jetblack' ),
				'section'           => 'jetblack_header_options',
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'jetblack_header_open_hours',
				'sanitize_callback' => 'jetblack_text_sanitization',
				'label'             => esc_html__( 'Open Hours', 'jetblack' ),
				'section'           => 'jetblack_header_options',
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'jetblack_header_button_text',
				'sanitize_callback' => 'jetblack_text_sanitization',
				'label'             => esc_html__( 'Button Text', 'jetblack' ),
				'section'           => 'jetblack_header_options',
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'settings'          => 'jetblack_header_button_link',
				'sanitize_callback' => 'esc_url_raw',
				'label'             => esc_html__( 'Button Link', 'jetblack' ),
				'section'           => 'jetblack_header_options',
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'JetBlack_Toggle_Switch_Custom_control',
				'settings'          => 'jetblack_header_button_target',
				'sanitize_callback' => 'jetblack_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'jetblack' ),
				'section'           => 'jetblack_header_options',
			)
		);
	}
}

/**
 * Initialize class
 */
$jetblack_theme_options = new JetBlack_Header_Options();
