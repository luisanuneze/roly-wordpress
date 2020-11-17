<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Photo_Journal
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photo_journal_testimonial_options( $wp_customize ) {
    // Add note to Jetpack Testimonial Section
    photo_journal_register_option( $wp_customize, array(
            'name'              => 'photo_journal_jetpack_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Photo_Journal_Note_Control',
            'label'             => sprintf( esc_html__( 'For Testimonial Options for Photo Journal Theme, go %1$shere%2$s', 'photo-journal' ),
                '<a href="javascript:wp.customize.section( \'photo_journal_testimonials\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'jetpack_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'photo_journal_testimonials', array(
            'panel'    => 'photo_journal_theme_options',
            'title'    => esc_html__( 'Testimonials', 'photo-journal' ),
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
            'name'              => 'photo_journal_testimonial_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Photo_Journal_Note_Control',
            'active_callback'   => 'photo_journal_is_ect_testimonial_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with testimonial Type Enabled', 'photo-journal' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'photo_journal_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    photo_journal_register_option( $wp_customize, array(
            'name'              => 'photo_journal_testimonial_option',
            'default'           => 'disabled',
            'active_callback'   => 'photo_journal_is_ect_testimonial_active',
            'sanitize_callback' => 'photo_journal_sanitize_select',
            'choices'           => photo_journal_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'photo-journal' ),
            'section'           => 'photo_journal_testimonials',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    photo_journal_register_option( $wp_customize, array(
            'name'              => 'photo_journal_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Photo_Journal_Note_Control',
            'active_callback'   => 'photo_journal_is_testimonial_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'photo-journal' ),
                '<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
                '</a>'
            ),
            'section'           => 'photo_journal_testimonials',
            'type'              => 'description',
        )
    );

    photo_journal_register_option( $wp_customize, array(
            'name'              => 'photo_journal_testimonial_number',
            'default'           => '4',
            'sanitize_callback' => 'photo_journal_sanitize_number_range',
            'active_callback'   => 'photo_journal_is_testimonial_active',
            'label'             => esc_html__( 'Number of items to show', 'photo-journal' ),
            'section'           => 'photo_journal_testimonials',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'photo_journal_testimonial_number', 4 );

    for ( $i = 1; $i <= $number ; $i++ ) {

        //for CPT
        photo_journal_register_option( $wp_customize, array(
                'name'              => 'photo_journal_testimonial_cpt_' . $i,
                'sanitize_callback' => 'photo_journal_sanitize_post',
                'active_callback'   => 'photo_journal_is_testimonial_active',
                'label'             => esc_html__( 'Testimonial', 'photo-journal' ) . ' ' . $i ,
                'section'           => 'photo_journal_testimonials',
                'type'              => 'select',
                'choices'           => photo_journal_generate_post_array( 'jetpack-testimonial' ),
            )
        );
    } // End for().
}
add_action( 'customize_register', 'photo_journal_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'photo_journal_is_testimonial_active' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since Photo Journal 0.1
    */
    function photo_journal_is_testimonial_active( $control ) {
        $enable = $control->manager->get_setting( 'photo_journal_testimonial_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
       return ( photo_journal_is_ect_testimonial_active( $control ) &&  photo_journal_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'photo_journal_is_ect_testimonial_inactive' ) ) :
    /**
    *
    * @since Photo Journal 1.0
    */
    function photo_journal_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

if ( ! function_exists( 'photo_journal_is_ect_testimonial_active' ) ) :
    /**
    *
    * @since Photo Journal 1.0
    */
    function photo_journal_is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;
