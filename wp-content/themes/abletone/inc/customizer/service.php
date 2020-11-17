<?php
/**
 * Services options
 *
 * @package Abletone Pro
 */

/**
 * Add service content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function abletone_service_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    abletone_register_option( $wp_customize, array(
            'name'              => 'abletone_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Abletone_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Services Options, go %1$shere%2$s', 'abletone' ),
                '<a href="javascript:wp.customize.section( \'abletone_service\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'abletone_service', array(
			'title' => esc_html__( 'Services', 'abletone' ),
			'panel' => 'abletone_theme_options',
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
            'name'              => 'abletone_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Abletone_Note_Control',
            'active_callback'   => 'abletone_is_ect_services_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Service Type Enabled', 'abletone' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'abletone_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_service_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'abletone_sanitize_select',
			'active_callback'   => 'abletone_is_ect_services_active',
			'choices'           => abletone_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'abletone' ),
			'section'           => 'abletone_service',
			'type'              => 'select',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_service_bg_image',
			'sanitize_callback' => 'abletone_sanitize_image',
			'active_callback'   => 'abletone_is_service_active',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Background Image', 'abletone' ),
			'section'           => 'abletone_service',
		)
	);

    abletone_register_option( $wp_customize, array(
            'name'              => 'abletone_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Abletone_Note_Control',
            'active_callback'   => 'abletone_is_service_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'abletone' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'abletone_service',
            'type'              => 'description',
        )
    );

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_service_number',
			'default'           => 4,
			'sanitize_callback' => 'abletone_sanitize_number_range',
			'active_callback'   => 'abletone_is_service_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Services is changed (Max no of Services is 20)', 'abletone' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'abletone' ),
			'section'           => 'abletone_service',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'abletone_service_number', 4 );

	//loop for service post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		abletone_register_option( $wp_customize, array(
				'name'              => 'abletone_service_cpt_' . $i,
				'sanitize_callback' => 'abletone_sanitize_post',
				'active_callback'   => 'abletone_is_service_active',
				'label'             => esc_html__( 'Services', 'abletone' ) . ' ' . $i ,
				'section'           => 'abletone_service',
				'type'              => 'select',
                'choices'           => abletone_generate_post_array( 'ect-service' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'abletone_service_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'abletone_is_service_active' ) ) :
	/**
	* Return true if service content is active
	*
	* @since Abletone Pro 1.0
	*/
	function abletone_is_service_active( $control ) {
		$enable = $control->manager->get_setting( 'abletone_service_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return abletone_check_section( $enable );
	}
endif;

if ( ! function_exists( 'abletone_is_ect_services_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Chique 1.0
    */
    function abletone_is_ect_services_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'abletone_is_ect_services_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Chique 1.0
    */
    function abletone_is_ect_services_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;
