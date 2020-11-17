<?php
/**
 * Header Media Options
 *
 * @package Abletone
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function abletone_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'abletone' );

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_header_media_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'abletone_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'abletone' ),
				'entire-site'            => esc_html__( 'Entire Site', 'abletone' ),
				'disable'                => esc_html__( 'Disabled', 'abletone' ),
			),
			'label'             => esc_html__( 'Enable on', 'abletone' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	/*Overlay Option for Header Media*/
	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_header_media_image_opacity',
			'default'           => '0',
			'sanitize_callback' => 'abletone_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'abletone' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_header_media_text_alignment',
			'default'           => 'text-align-left',
			'sanitize_callback' => 'abletone_sanitize_select',
			'choices'           => array(
				'text-align-center' => esc_html__( 'Center', 'abletone' ),
				'text-align-right'  => esc_html__( 'Right', 'abletone' ),
				'text-align-left'   => esc_html__( 'Left', 'abletone' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'abletone' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_header_media_content_alignment',
			'default'           => 'content-align-left',
			'sanitize_callback' => 'abletone_sanitize_select',
			'choices'           => array(
				'content-align-center' => esc_html__( 'Center', 'abletone' ),
				'content-align-right'  => esc_html__( 'Right', 'abletone' ),
				'content-align-left'   => esc_html__( 'Left', 'abletone' ),
			),
			'label'             => esc_html__( 'Content Alignment', 'abletone' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_header_media_logo',
			'sanitize_callback' => 'esc_url_raw',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Header Media Logo', 'abletone' ),
			'section'           => 'header_image',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_header_media_logo_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'abletone_sanitize_select',
			'active_callback'   => 'abletone_is_header_media_logo_active',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'abletone' ),
				'entire-site'            => esc_html__( 'Entire Site', 'abletone' ) ),
			'label'             => esc_html__( 'Enable Header Media logo on', 'abletone' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'abletone' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Site Header Text', 'abletone' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_header_media_url',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'abletone' ),
			'section'           => 'header_image',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'abletone' ),
			'section'           => 'header_image',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_header_url_target',
			'sanitize_callback' => 'abletone_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'abletone' ),
			'section'           => 'header_image',
			'custom_control'    => 'Abletone_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'abletone_header_media_options' );

/** Active Callback Functions */

if ( ! function_exists( 'abletone_is_header_media_logo_active' ) ) :
	/**
	* Return true if header logo is active
	*
	* @since Abletone 0.1
	*/
	function abletone_is_header_media_logo_active( $control ) {
		$logo = $control->manager->get_setting( 'abletone_header_media_logo' )->value();
		if ( '' != $logo ) {
			return true;
		} else {
			return false;
		}
	}
endif;
