<?php
/**
 * Featured Slider Options
 *
 * @package Photo_Journal
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photo_journal_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'photo_journal_featured_slider', array(
			'panel' => 'photo_journal_theme_options',
			'title' => esc_html__( 'Featured Slider', 'photo-journal' ),
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'photo_journal_sanitize_select',
			'choices'           => photo_journal_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'photo-journal' ),
			'section'           => 'photo_journal_featured_slider',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'photo_journal_sanitize_number_range',

			'active_callback'   => 'photo_journal_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'photo-journal' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'photo-journal' ),
			'section'           => 'photo_journal_featured_slider',
			'type'              => 'number',
		)
	);

	$slider_number = get_theme_mod( 'photo_journal_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {

		// Page Sliders
		photo_journal_register_option( $wp_customize, array(
				'name'              =>'photo_journal_slider_page_' . $i,
				'sanitize_callback' => 'photo_journal_sanitize_post',
				'active_callback'   => 'photo_journal_is_slider_active',
				'label'             => esc_html__( 'Page', 'photo-journal' ) . ' # ' . $i,
				'section'           => 'photo_journal_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().

}
add_action( 'customize_register', 'photo_journal_slider_options' );

/** Active Callback Functions */

if( ! function_exists( 'photo_journal_is_slider_active' ) ) :
	/**
	* Return true if page slider is active
	*
	* @since Photo Journal 1.0
	*/
	function photo_journal_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'photo_journal_slider_option' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is or is not selected type
		return ( photo_journal_check_section( $enable ) );
	}
endif;
