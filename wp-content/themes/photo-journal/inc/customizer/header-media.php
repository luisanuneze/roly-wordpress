<?php
/**
 * Header Media Options
 *
 * @package Photo_Journal
 */

function photo_journal_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'photo-journal' );

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_header_media_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'photo_journal_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'photo-journal' ),
				'entire-site'            => esc_html__( 'Entire Site', 'photo-journal' ),
				'disable'                => esc_html__( 'Disabled', 'photo-journal' ),
			),
			'label'             => esc_html__( 'Enable on ', 'photo-journal' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'photo-journal' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Text', 'photo-journal' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_header_media_url',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'photo-journal' ),
			'section'           => 'header_image',
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'photo-journal' ),
			'section'           => 'header_image',
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_header_url_target',
			'sanitize_callback' => 'photo_journal_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'photo-journal' ),
			'section'           => 'header_image',
			'custom_control'	=> 'Photo_Journal_Toggle_Control',
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_header_scroll_down',
			'default'			=> 1,
			'sanitize_callback' => 'photo_journal_sanitize_checkbox',
			'label'             => esc_html__( 'Scroll Link', 'photo-journal' ),
			'section'           => 'header_image',
			'custom_control'	=> 'Photo_Journal_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'photo_journal_header_media_options' );

