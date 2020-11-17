<?php
/**
 * JetBlack Theme Customizer
 *
 * @package JetBlack
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jetblack_sortable_sections( $wp_customize ) {
	$wp_customize->add_panel( 'jetblack_sp_sortable', array(
		'title'       => esc_html__( 'Sections', 'jetblack' ),
		'priority'    => 150,
	) );

	$sortable_sections = array (
        'slider'               => esc_html__( 'Slider', 'jetblack' ),
        'wwd'                  => esc_html__( 'What We Do', 'jetblack' ),
        'hero_content'         => esc_html__( 'Hero Content', 'jetblack' ),
        'featured_product'     => esc_html__( 'Featured Product', 'jetblack' ),
        'portfolio'            => esc_html__( 'Portfolio', 'jetblack' ),
        'testimonial'          => esc_html__( 'Testimonials', 'jetblack' ),
        'featured_content'     => esc_html__( 'Featured Content', 'jetblack' ),
    );

	foreach ( $sortable_sections as $key => $value ) {
			// Add sections.
			$wp_customize->add_section( 'jetblack_ss_' . $key,
				array(
					'title' => $value,
					'panel' => 'jetblack_sp_sortable'
				)
			);
		
	}
}
add_action( 'customize_register', 'jetblack_sortable_sections', 1 );
