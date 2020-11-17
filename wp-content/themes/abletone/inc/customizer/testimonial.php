<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Abletone
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function abletone_testimonial_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_jetpack_testimonial_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Abletone_Note_Control',
			'label'             => sprintf( esc_html__( 'For Testimonial Options for Abletoneazine Theme, go %1$shere%2$s', 'abletone' ),
				'<a href="javascript:wp.customize.section( \'abletone_testimonials\' ).focus();">',
				 '</a>'
			),
		   'section'            => 'jetpack_testimonials',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'abletone_testimonials', array(
			'panel'    => 'abletone_theme_options',
			'title'    => esc_html__( 'Testimonials', 'abletone' ),
		)
	);

	    $action = 'install-plugin';
    $slug   = 'essential-content-types';

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

    abletone_register_option( $wp_customize, array(
            'name'              => 'abletone_testimonial_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Abletone_Note_Control',
            'active_callback'   => 'abletone_is_ect_testimonial_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with testimonial Type Enabled', 'abletone' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'abletone_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_testimonial_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'abletone_sanitize_select',
			'active_callback'   => 'abletone_is_ect_testimonial_active',
			'choices'           => abletone_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'abletone' ),
			'section'           => 'abletone_testimonials',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_testimonial_bg_image',
			'sanitize_callback' => 'abletone_sanitize_image',
			'active_callback'   => 'abletone_is_testimonial_active',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Background Image', 'abletone' ),
			'section'           => 'abletone_testimonials',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_testimonial_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Abletone_Note_Control',
			'active_callback'   => 'abletone_is_testimonial_active',
			/* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'abletone' ),
				'<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
				'</a>'
			),
			'section'           => 'abletone_testimonials',
			'type'              => 'description',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_testimonial_number',
			'default'           => '3',
			'sanitize_callback' => 'abletone_sanitize_number_range',
			'active_callback'   => 'abletone_is_testimonial_active',
			'label'             => esc_html__( 'Number of items', 'abletone' ),
			'section'           => 'abletone_testimonials',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'abletone_testimonial_number', 3 );

	for ( $i = 1; $i <= $number ; $i++ ) {
		//for CPT
		abletone_register_option( $wp_customize, array(
				'name'              => 'abletone_testimonial_cpt_' . $i,
				'sanitize_callback' => 'abletone_sanitize_post',
				'active_callback'   => 'abletone_is_testimonial_active',
				'label'             => esc_html__( 'Testimonial', 'abletone' ) . ' ' . $i ,
				'section'           => 'abletone_testimonials',
				'type'              => 'select',
				'choices'           => abletone_generate_post_array( 'jetpack-testimonial' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'abletone_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'abletone_is_testimonial_active' ) ) :
	/**
	* Return true if testimonial is active
	*
	* @since Abletone 0.1
	*/
	function abletone_is_testimonial_active( $control ) {
		$enable = $control->manager->get_setting( 'abletone_testimonial_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return abletone_check_section( $enable );
	}
endif;

if ( ! function_exists( 'abletone_is_ect_testimonial_inactive' ) ) :
    /**
    *
    * @since Chique 1.0
    */
    function abletone_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

if ( ! function_exists( 'abletone_is_ect_testimonial_active' ) ) :
    /**
    *
    * @since Chique 1.0
    */
    function abletone_is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;
