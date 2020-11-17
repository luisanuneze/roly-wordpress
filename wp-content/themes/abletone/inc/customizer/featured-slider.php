<?php
/**
 * Featured Slider Options
 *
 * @package Abletone
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function abletone_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'abletone_featured_slider', array(
			'panel' => 'abletone_theme_options',
			'title' => esc_html__( 'Featured Slider', 'abletone' ),
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'abletone_sanitize_select',
			'choices'           => abletone_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'abletone' ),
			'section'           => 'abletone_featured_slider',
			'type'              => 'select',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'abletone_sanitize_number_range',

			'active_callback'   => 'abletone_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'abletone' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'abletone' ),
			'section'           => 'abletone_featured_slider',
			'type'              => 'number',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_slider_content_show',
			'default'           => 'hide-content',
			'sanitize_callback' => 'abletone_sanitize_select',
			'active_callback'   => 'abletone_is_slider_active',
			'choices'           => abletone_content_show(),
			'label'             => esc_html__( 'Display Content', 'abletone' ),
			'section'           => 'abletone_featured_slider',
			'type'              => 'select',
		)
	);

	$slider_number = get_theme_mod( 'abletone_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {
		abletone_register_option( $wp_customize, array(
				'name'              => 'abletone_slider_note_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'custom_control'    => 'Abletone_Note_Control',
				'active_callback'   => 'abletone_is_slider_active',
				'label'             => esc_html__( 'Slide #', 'abletone' ) . $i,
				'section'           => 'abletone_featured_slider',
				'type'              => 'description',
			)
		);

		// Page Sliders
		abletone_register_option( $wp_customize, array(
				'name'              => 'abletone_slider_page_' . $i,
				'sanitize_callback' => 'abletone_sanitize_post',
				'active_callback'   => 'abletone_is_slider_active',
				'label'             => esc_html__( 'Page', 'abletone' ) . ' # ' . $i,
				'section'           => 'abletone_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);

		abletone_register_option( $wp_customize, array(
				'name'              => 'abletone_slider_title_image_' . $i,
				'sanitize_callback' => 'abletone_sanitize_image',
				'custom_control'    => 'WP_Customize_Image_Control',
				'active_callback'   => 'abletone_is_slider_active',
				'label'             => esc_html__( 'Title Image', 'abletone' ),
				'section'           => 'abletone_featured_slider',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'abletone_slider_options' );

/** Active Callback Functions */

if ( ! function_exists( 'abletone_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Abletone 0.1
	*/
	function abletone_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'abletone_slider_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return abletone_check_section( $enable );
	}
endif;