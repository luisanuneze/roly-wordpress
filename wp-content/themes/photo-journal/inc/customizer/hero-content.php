<?php
/**
 * Hero Content Options
 *
 * @package Photo_Journal
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photo_journal_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'photo_journal_hero_content_options', array(
			'title' => esc_html__( 'Hero Content Options', 'photo-journal' ),
			'panel' => 'photo_journal_theme_options',
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'photo_journal_sanitize_select',
			'choices'           => photo_journal_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'photo-journal' ),
			'section'           => 'photo_journal_hero_content_options',
			'type'              => 'select',
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'photo_journal_sanitize_post',
			'active_callback'   => 'photo_journal_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'photo-journal' ),
			'section'           => 'photo_journal_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);
}
add_action( 'customize_register', 'photo_journal_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'photo_journal_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Photo Journal 0.1
	*/
	function photo_journal_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'photo_journal_hero_content_visibility' )->value();


		return ( photo_journal_check_section( $enable ) );
	}
endif;
