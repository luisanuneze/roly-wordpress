<?php
/**
 * Olsen_Light onboarding related code.
 */

if ( ! defined( 'OLSEN_LIGHT_WHITELABEL' ) || false === (bool) OLSEN_LIGHT_WHITELABEL ) {
	add_action( 'pt-ocdi/after_import', 'olsen_light_ocdi_after_import_setup' );
}

add_filter( 'pt-ocdi/timeout_for_downloading_import_file', 'olsen_light_ocdi_download_timeout' );
function olsen_light_ocdi_download_timeout( $timeout ) {
	return 60;
}

add_filter( 'pt-ocdi/plugin_intro_text', 'olsen_light_ocdi_intro_text' );
function olsen_light_ocdi_intro_text( $html ) {
	$sample_content_url = olsen_light_documentation_url() . '#sample-content';

	ob_start();
	?>
	<p><?php
		/* translators: %s is a url. */
		echo wp_kses_post( sprintf( __( 'Looking for the Olsen Light sample content files? Download them <a href="%s" target="_blank">here</a>.', 'olsen-light' ), esc_url( $sample_content_url ) ) );
	?></p>
	<hr>
	<?php

	$append_html = ob_get_clean();

	return $html . $append_html;
}

function olsen_light_ocdi_after_import_setup() {
	// Set up nav menus.
	$main_menu   = get_term_by( 'name', 'Main', 'nav_menu' );
	$footer_menu = get_term_by( 'name', 'Footer', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
		'main_menu'   => $main_menu->term_id,
		'footer_menu' => $footer_menu->term_id,
	) );

	update_option( 'show_on_front', 'posts' );

	// Try to force a term recount.
	// wp_defer_term_counting( false ) doesn't work properly as there are post imported from different AJAX requests.
	$taxonomies = get_taxonomies( array(), 'names' );
	foreach ( $taxonomies as $taxonomy ) {
		$terms             = get_terms( $taxonomy, array( 'hide_empty' => false ) );
		$term_taxonomy_ids = wp_list_pluck( $terms, 'term_taxonomy_id' );

		wp_update_term_count( $term_taxonomy_ids, $taxonomy );
	}
}

function olsen_light_get_theme_required_plugins() {
	return apply_filters( 'olsen_light_theme_required_plugins', array() );
}

function olsen_light_get_theme_recommended_plugins() {
	return apply_filters( 'olsen_light_theme_recommended_plugins', array(
		'gutenbee'              => array(
			'title'       => __( 'GutenBee', 'olsen-light' ),
			'description' => __( 'Premium blocks for WordPress.', 'olsen-light' ),
		),
		'maxslider'             => array(
			'title'       => __( 'MaxSlider', 'olsen-light' ),
			'description' => __( 'Add a custom responsive slider to any page of your website.', 'olsen-light' ),
		),
		'wp-smushit'            => array(
			'title'       => __( 'Smush by WPMU DEV', 'olsen-light' ),
			'description' => __( 'Compress, Optimize and Lazy Load Images.', 'olsen-light' ),
			'plugin_file' => 'wp-smush.php',
		),
		'wpforms-lite'          => array(
			'title'       => __( 'Contact Form by WPForms', 'olsen-light' ),
			'description' => __( 'Drag & Drop Form Builder for WordPress.', 'olsen-light' ),
			'plugin_file' => 'wpforms.php',
			'is_callable' => 'wpforms',
		),
		'one-click-demo-import' => array(
			'title'              => __( 'One Click Demo Import', 'olsen-light' ),
			'description'        => __( 'Import your demo content, widgets and theme settings with one click.', 'olsen-light' ),
			'required_by_sample' => true,
		),
	) );
}

add_action( 'init', 'olsen_light_onboarding_page_init' );
function olsen_light_onboarding_page_init() {
	$data = array(
		'show_page'                => true,
		'redirect_on_activation'   => false,
		'description'              => __( 'Olsen Light is a clean and elegant WordPress blog theme, perfect for lifestyle, food, fashion, travel, health & fitness, photography and beauty blogging. It is 100% responsive, customizable and easy to use. It is also compatible with the most popular page builders like Elementor, Divi, Brizy and Beaver Builder.', 'olsen-light' ),
		'default_tab'              => 'recommended_plugins',
		'tabs'                     => array(
			'required_plugins'    => '',
			'recommended_plugins' => __( 'Recommended Plugins', 'olsen-light' ),
			'sample_content'      => __( 'Sample Content', 'olsen-light' ),
			'support'             => __( 'Support', 'olsen-light' ),
			'upgrade_pro'         => __( 'Upgrade to Pro', 'olsen-light' ),
		),
		'required_plugins_page'    => array(
			'plugins' => olsen_light_get_theme_required_plugins(),
		),
		'recommended_plugins_page' => array(
			'plugins' => olsen_light_get_theme_recommended_plugins(),
		),

	);

	require_once get_theme_file_path( '/inc/class-onboarding-page-lite.php' );

	$onboarding = new Olsen_Light_Onboarding_Page_Lite();
	$onboarding->init( apply_filters( 'olsen_light_onboarding_page_array', $data ) );
}

/**
 * User onboarding.
 */
require_once get_theme_file_path( '/inc/onboarding/onboarding-page.php' );
