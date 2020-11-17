<?php
/**
 * Playlist Options
 *
 * @package Abletone
 */

/**
 * Add sticky_playlist options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function abletone_sticky_playlist( $wp_customize ) {
	$wp_customize->add_section( 'abletone_sticky_playlist', array(
			'title' => esc_html__( 'Sticky Playlist', 'abletone' ),
			'panel' => 'abletone_theme_options',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_sticky_playlist_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'abletone_sanitize_select',
			'choices'           => abletone_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'abletone' ),
			'section'           => 'abletone_sticky_playlist',
			'type'              => 'select',
		)
	);

	abletone_register_option( $wp_customize, array(
			'name'              => 'abletone_sticky_playlist',
			'default'           => '0',
			'sanitize_callback' => 'abletone_sanitize_post',
			'active_callback'   => 'abletone_is_sticky_playlist_active',
			'label'             => esc_html__( 'Page', 'abletone' ),
			'section'           => 'abletone_sticky_playlist',
			'type'              => 'dropdown-pages',
		)
	);
}
add_action( 'customize_register', 'abletone_sticky_playlist', 12 );

/** Active Callback Functions **/
if ( ! function_exists( 'abletone_is_sticky_playlist_active' ) ) :
	/**
	* Return true if sticky_playlist is active
	*
	* @since Abletone 0.1
	*/
	function abletone_is_sticky_playlist_active( $control ) {
		$enable = $control->manager->get_setting( 'abletone_sticky_playlist_visibility' )->value();

		return abletone_check_section( $enable );
	}
endif;