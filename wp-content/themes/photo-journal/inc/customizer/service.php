<?php
/**
* The template for adding Service Settings in Customizer
*
 * @package Photo_Journal
*/

function photo_journal_service_options( $wp_customize ) {
	// Add note to Jetpack Portfolio Section
    photo_journal_register_option( $wp_customize, array(
            'name'              => 'photo_journal_jetpack_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Photo_Journal_Note_Control',
            'label'             => sprintf( esc_html__( 'For Service Options for Photo Journal Theme, go %1$shere%2$s', 'photo-journal' ),
                 '<a href="javascript:wp.customize.section( \'photo_journal_service\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'ect_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	$wp_customize->add_section( 'photo_journal_service', array(
			'panel'    => 'photo_journal_theme_options',
			'title'    => esc_html__( 'Service', 'photo-journal' ),
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

    photo_journal_register_option( $wp_customize, array(
            'name'              => 'photo_journal_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Photo_Journal_Note_Control',
            'active_callback'   => 'photo_journal_is_ect_services_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Service Type Enabled', 'photo-journal' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'photo_journal_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_service_option',
			'default'           => 'disabled',
			'active_callback'   => 'photo_journal_is_ect_services_active',
			'sanitize_callback' => 'photo_journal_sanitize_select',
			'choices'           => photo_journal_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'photo-journal' ),
			'section'           => 'photo_journal_service',
			'type'              => 'select',
		)
	);

	photo_journal_register_option( $wp_customize, array(
            'name'              => 'photo_journal_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Photo_Journal_Note_Control',
            'active_callback'   => 'photo_journal_is_service_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'photo-journal' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'photo_journal_service',
            'type'              => 'description',
        )
    );

	photo_journal_register_option( $wp_customize, array(
				'name'              => 'photo_journal_service_number',
				'default'           => 4,
				'sanitize_callback' => 'photo_journal_sanitize_number_range',
				'active_callback'   => 'photo_journal_is_service_active',
				'description'       => esc_html__( 'Save and refresh the page if No. of Service is changed', 'photo-journal' ),
				'input_attrs'       => array(
					'style' => 'width: 100px;',
					'min'   => 0,
				),
				'label'             => esc_html__( 'No of Service', 'photo-journal' ),
				'section'           => 'photo_journal_service',
				'type'              => 'number',
		)
	);

	$number = get_theme_mod( 'photo_journal_service_number', 4 );

	for ( $i = 1; $i <= $number ; $i++ ) {

		//for CPT
		photo_journal_register_option( $wp_customize, array(
				'name'              => 'photo_journal_service_cpt_' . $i,
				'sanitize_callback' => 'photo_journal_sanitize_post',
				'default'           => 0,
				'active_callback'   => 'photo_journal_is_service_active',
				'label'             => esc_html__( 'Service ', 'photo-journal' ) . ' ' . $i ,
				'section'           => 'photo_journal_service',
				'type'              => 'select',
				'choices'           => photo_journal_generate_post_array( 'ect-service' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'photo_journal_service_options' );

if ( ! function_exists( 'photo_journal_is_service_active' ) ) :
	/**
	* Return true if service is active
	*
	* @since Photo Journal 0.1
	*/
	function photo_journal_is_service_active( $control ) {
		$enable = $control->manager->get_setting( 'photo_journal_service_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( photo_journal_is_ect_services_active( $control ) &&  photo_journal_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'photo_journal_is_ect_services_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Photo Journal 1.0
    */
    function photo_journal_is_ect_services_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'photo_journal_is_ect_services_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Photo Journal 1.0
    */
    function photo_journal_is_ect_services_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;
