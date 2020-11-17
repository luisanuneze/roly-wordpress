<?php
add_action( 'customize_register', 'olsen_light_customize_register', 100 );
/**
 * Registers all theme-related options to the Customizer.
 *
 * @param WP_Customize_Manager $wpc Reference to the customizer's manager object.
 */
function olsen_light_customize_register( $wpc ) {

	$wpc->add_section( 'top-bar', array(
		'title'       => _x( 'Top Bar Options', 'customizer section title', 'olsen-light' ),
		'description' => __( 'To show/hide the top bar set/unset the menu in the top bar menu location.', 'olsen-light' ),
		'priority'    => 1
	) );

	require_once get_theme_file_path( 'inc/customizer/options/top-bar.php' );

	$wpc->add_section( 'header', array(
		'title'    => esc_html_x( 'Header Options', 'customizer section title', 'olsen-light' ),
		'priority' => 10
	) );

	require_once get_theme_file_path( 'inc/customizer/options/header.php' );

	$wpc->get_panel( 'nav_menus' )->priority = 15;

	require_once get_theme_file_path( 'inc/customizer/options/site-tagline.php' );

	$wpc->add_section( 'layout', array(
		'title'    => esc_html_x( 'Layout Options', 'customizer section title', 'olsen-light' ),
		'priority' => 25
	) );

	require_once get_theme_file_path( 'inc/customizer/options/layout.php' );

	$wpc->add_section( 'homepage', array(
		'title'    => _x( 'Front Page Carousel', 'customizer section title', 'olsen-light' ),
		'priority' => 30
	) );

	require_once get_theme_file_path( 'inc/customizer/options/homepage.php' );

	// The following line doesn't work in a some PHP versions. Apparently, get_panel( 'widgets' ) returns an array,
	// therefore a cast to object is needed. http://wordpress.stackexchange.com/questions/160987/warning-creating-default-object-when-altering-customize-panels
	//$wpc->get_panel( 'widgets' )->priority = 55;
	$panel_widgets = (object) $wpc->get_panel( 'widgets' );
    $panel_widgets->priority = 55;

	$wpc->add_section( 'social', array(
		'title'       => esc_html_x( 'Social Networks', 'customizer section title', 'olsen-light' ),
		'description' => esc_html__( 'Enter your social network URLs. Leaving a URL empty will hide its respective icon.', 'olsen-light' ),
		'priority'    => 60
	) );

	require_once get_theme_file_path( 'inc/customizer/options/social.php' );

	$wpc->add_section( 'single_post', array(
		'title'       => esc_html_x( 'Posts Options', 'customizer section title', 'olsen-light' ),
		'description' => esc_html__( 'These options affect your individual posts.', 'olsen-light' ),
		'priority'    => 70
	) );

	require_once get_theme_file_path( 'inc/customizer/options/single-post.php' );

	$wpc->add_section( 'footer', array(
		'title'    => esc_html_x( 'Footer Options', 'customizer section title', 'olsen-light' ),
		'priority' => 100
	) );

	require_once get_theme_file_path( 'inc/customizer/options/footer.php' );

	// Section 'static_front_page' is not defined when there are no pages.
	if ( get_pages() ) {
		$wpc->get_section( 'static_front_page' )->priority = 110;
	}

	$wpc->add_section( 'theme_upgrade', array(
		'title'    => esc_html_x( 'Upgrade to Pro', 'customizer section title', 'olsen-light' ),
		'priority' => 130
	) );

	require_once get_theme_file_path( 'inc/customizer/options/theme-upgrade.php' );

}

require_once get_theme_file_path( '/inc/customizer/customizer-styles.php' );

add_action( 'customize_controls_print_styles', 'olsen_light_enqueue_customizer_styles' );
function olsen_light_enqueue_customizer_styles() {
	$theme = wp_get_theme();

	wp_register_style( 'olsen-light-customizer-styles', get_template_directory_uri() . '/inc/customizer/assets/customizer-styles.css', array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'olsen-light-customizer-styles' );
}

add_action( 'customize_controls_enqueue_scripts', 'olsen_light_enqueue_customizer_scripts' );
function olsen_light_enqueue_customizer_scripts() {
	$theme = wp_get_theme();

	wp_register_script( 'olsen-light-customizer-scripts', get_template_directory_uri() . '/inc/customizer/assets/customizer-scripts.js', array( 'jquery' ), $theme->get( 'Version' ), true );
	$params = array(
		'documentation_text' => esc_html__( 'Documentation', 'olsen-light' ),
		'upgrade_text'       => esc_html__( 'Upgrade to Pro', 'olsen-light' ),
	);
	wp_localize_script( 'olsen-light-customizer-scripts', 'olsen_light_customizer', $params );
	wp_enqueue_script( 'olsen-light-customizer-scripts' );
}

add_action( 'customize_register', 'olsen_light_customize_register_custom_controls', 9 );
/**
 * Registers custom Customizer controls.
 *
 * @param WP_Customize_Manager $wpc Reference to the customizer's manager object.
 */
function olsen_light_customize_register_custom_controls( $wpc ) {
	require get_template_directory() . '/inc/customizer/customizer-controls/static-text.php';
	require get_template_directory() . '/inc/customizer/customizer-controls/slick.php';
}
