<?php
/**
 * Hero Content Options
 *
 * @package Abletone
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function abletone_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'abletone_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'abletone' ),
			'panel' => 'abletone_theme_options',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'abletone_sanitize_select',
			'choices'           => abletone_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'abletone' ),
			'section'           => 'abletone_hero_content_options',
			'type'              => 'select',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'abletone_sanitize_post',
			'active_callback'   => 'abletone_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'abletone' ),
			'section'           => 'abletone_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_hero_content_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'abletone_sanitize_select',
			'active_callback'   => 'abletone_is_hero_content_active',
			'choices'           => abletone_content_show(),
			'label'             => esc_html__( 'Display Content', 'abletone' ),
			'section'           => 'abletone_hero_content_options',
			'type'              => 'select',
		)
	);
}
add_action( 'customize_register', 'abletone_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'abletone_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Abletone 0.1
	*/
	function abletone_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'abletone_hero_content_visibility' )->value();

		return abletone_check_section( $enable );
	}
endif;
