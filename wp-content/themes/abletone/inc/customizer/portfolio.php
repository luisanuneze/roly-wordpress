<?php
/**
 * Add Portfolio Settings in Customizer
 *
 * @package Abletone
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function abletone_portfolio_options( $wp_customize ) {
	// Add note to Jetpack Portfolio Section
	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_jetpack_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Abletone_Note_Control',
			'label'             => sprintf( esc_html__( 'For Portfolio Options for Abletone Theme, go %1$shere%2$s', 'abletone' ),
				 '<a href="javascript:wp.customize.section( \'abletone_portfolio\' ).focus();">',
				 '</a>'
			),
			'section'           => 'jetpack_portfolio',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'abletone_portfolio', array(
			'panel'    => 'abletone_theme_options',
			'title'    => esc_html__( 'Portfolio', 'abletone' ),
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
            'name'              => 'abletone_portfolio_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Abletone_Note_Control',
          	'active_callback'   => 'abletone_is_ect_portfolio_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Portfolio, install %1$sEssential Content Types%2$s Plugin with Portfolio Type Enabled', 'abletone' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'abletone_portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_portfolio_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'abletone_sanitize_select',
			'active_callback'   => 'abletone_is_ect_portfolio_active',
			'choices'           => abletone_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'abletone' ),
			'section'           => 'abletone_portfolio',
			'type'              => 'select',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_portfolio_bg_image',
			'sanitize_callback' => 'abletone_sanitize_image',
			'active_callback'   => 'abletone_is_portfolio_active',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Background Image', 'abletone' ),
			'section'           => 'abletone_portfolio',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Abletone_Note_Control',
			'active_callback'   => 'abletone_is_portfolio_active',
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'abletone' ),
				 '<a href="javascript:wp.customize.control( \'jetpack_portfolio_title\' ).focus();">',
				 '</a>'
			),
			'section'           => 'abletone_portfolio',
			'type'              => 'description',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_portfolio_number',
			'default'           => 6,
			'sanitize_callback' => 'abletone_sanitize_number_range',
			'active_callback'   => 'abletone_is_portfolio_active',
			'label'             => esc_html__( 'Number of items to show', 'abletone' ),
			'section'           => 'abletone_portfolio',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'abletone_portfolio_number', 6 );

	for ( $i = 1; $i <= $number ; $i++ ) {
		//for CPT
		abletone_register_option( $wp_customize, array(
				'name'              => 'abletone_portfolio_cpt_' . $i,
				'sanitize_callback' => 'abletone_sanitize_post',
				'active_callback'   => 'abletone_is_portfolio_active',
				'label'             => esc_html__( 'Portfolio', 'abletone' ) . ' ' . $i ,
				'section'           => 'abletone_portfolio',
				'type'              => 'select',
				'choices'           => abletone_generate_post_array( 'jetpack-portfolio' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'abletone_portfolio_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'abletone_is_portfolio_active' ) ) :
	/**
	* Return true if portfolio is active
	*
	* @since Abletone 0.1
	*/
	function abletone_is_portfolio_active( $control ) {
		$enable = $control->manager->get_setting( 'abletone_portfolio_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return abletone_check_section( $enable );
	}
endif;

if ( ! function_exists( 'abletone_is_ect_portfolio_inactive' ) ) :
    /**
    *
    * @since Chique 1.0
    */
    function abletone_is_ect_portfolio_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

if ( ! function_exists( 'abletone_is_ect_portfolio_active' ) ) :
    /**
    *
    * @since Chique 1.0
    */
    function abletone_is_ect_portfolio_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;