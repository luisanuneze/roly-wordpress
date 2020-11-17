<?php
/**
 * Adds the theme options sections, settings, and controls to the theme customizer
 *
 * @package JetBlack
 */

class JetBlack_Theme_Options {
	public function __construct() {
		// Register our Panel.
		add_action( 'customize_register', array( $this, 'add_panel' ) );

		// Register Breadcrumb Options.
		add_action( 'customize_register', array( $this, 'register_breadcrumb_options' ) );

		// Register Excerpt Options.
		add_action( 'customize_register', array( $this, 'register_excerpt_options' ) );

		// Register Homepage Options.
		add_action( 'customize_register', array( $this, 'register_homepage_options' ) );

		// Register Layout Options.
		add_action( 'customize_register', array( $this, 'register_layout_options' ) );

		// Register Search Options.
		add_action( 'customize_register', array( $this, 'register_search_options' ) );

		// Add default options.
		add_filter( 'jetblack_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			// Header Media.
			'jetblack_header_image_visibility' => 'entire-site',

			// Breadcrumb
			'jetblack_breadcrumb_show' => 1,

			// Layout Options.
			'jetblack_layout_type'             => 'fluid',
			'jetblack_default_layout'          => 'right-sidebar',
			'jetblack_homepage_archive_layout' => 'no-sidebar-full-width',
			
			// Excerpt Options
			'jetblack_excerpt_length'    => 30,
			'jetblack_excerpt_more_text' => esc_html__( 'Continue reading', 'jetblack' ),

			// Homepage/Frontpage Options.
			'jetblack_front_page_category'   => '',
			
			// Search Options.
			'jetblack_search_text'         => esc_html__( 'Search...', 'jetblack' ),
		);


		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Register the Customizer panels
	 */
	public function add_panel( $wp_customize ) {
		/**
		 * Add our Header & Navigation Panel
		 */
		 $wp_customize->add_panel( 'jetblack_theme_options',
		 	array(
				'title' => esc_html__( 'Theme Options', 'jetblack' ),
			)
		);
	}

	/**
	 * Add breadcrumb section and its controls
	 */
	public function register_breadcrumb_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'jetblack_breadcrumb_options',
			array(
				'title' => esc_html__( 'Breadcrumb', 'jetblack' ),
				'panel' => 'jetblack_theme_options',
			)
		);

		if ( function_exists( 'bcn_display' ) ) {
			JetBlack_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'JetBlack_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'ff_multiputpose_breadcrumb_plugin_notice',
					'label'             =>  esc_html__( 'Info', 'jetblack' ),
					'description'       =>  sprintf( esc_html__( 'Since Breadcrumb NavXT Plugin is installed, edit plugin\'s settings %1$shere%2$s', 'jetblack' ), '<a href="' . esc_url( get_admin_url( null, 'options-general.php?page=breadcrumb-navxt' ) ) . '" target="_blank">', '</a>' ),
					'section'           => 'ff_multiputpose_breadcrumb_options',
				)
			);

			return;
		}

		JetBlack_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'JetBlack_Toggle_Switch_Custom_control',
				'settings'          => 'jetblack_breadcrumb_show',
				'sanitize_callback' => 'jetblack_switch_sanitization',
				'label'             => esc_html__( 'Display Breadcrumb?', 'jetblack' ),
				'section'           => 'jetblack_breadcrumb_options',
			)
		);
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_layout_options( $wp_customize ) {
		// Add layouts section.
		$wp_customize->add_section( 'jetblack_layouts',
			array(
				'title' => esc_html__( 'Layouts', 'jetblack' ),
				'panel' => 'jetblack_theme_options'
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'jetblack_layout_type',
				'sanitize_callback' => 'jetblack_sanitize_select',
				'label'             => esc_html__( 'Site Layout', 'jetblack' ),
				'section'           => 'jetblack_layouts',
				'choices'           => array(
					'fluid' => esc_html__( 'Fluid', 'jetblack' ),
					'boxed' => esc_html__( 'Boxed', 'jetblack' ),
				),
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'jetblack_default_layout',
				'sanitize_callback' => 'jetblack_sanitize_select',
				'label'             => esc_html__( 'Default Layout', 'jetblack' ),
				'section'           => 'jetblack_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'jetblack' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'jetblack' ),
				),
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'jetblack_homepage_archive_layout',
				'sanitize_callback' => 'jetblack_sanitize_select',
				'label'             => esc_html__( 'Homepage/Archive Layout', 'jetblack' ),
				'section'           => 'jetblack_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'jetblack' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'jetblack' ),
				),
			)
		);
	}

	/**
	 * Add excerpt section and its controls
	 */
	public function register_excerpt_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'jetblack_excerpt_options',
			array(
				'title' => esc_html__( 'Excerpt Options', 'jetblack' ),
				'panel' => 'jetblack_theme_options',
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'jetblack_excerpt_length',
				'sanitize_callback' => 'absint',
				'label'             => esc_html__( 'Excerpt Length (Words)', 'jetblack' ),
				'section'           => 'jetblack_excerpt_options',
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'jetblack_excerpt_more_text',
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Excerpt More Text', 'jetblack' ),
				'section'           => 'jetblack_excerpt_options',
			)
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_homepage_options( $wp_customize ) {
		JetBlack_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'JetBlack_Dropdown_Select2_Custom_Control',
				'sanitize_callback' => 'jetblack_text_sanitization',
				'settings'          => 'jetblack_front_page_category',
				'description'       => esc_html__( 'Filter Homepage/Blog page posts by following categories', 'jetblack' ),
				'label'             => esc_html__( 'Categories', 'jetblack' ),
				'section'           => 'static_front_page',
				'input_attrs'       => array(
					'multiselect' => true,
				),
				'choices'           => array( esc_html__( '--Select--', 'jetblack' ) => JetBlack_Customizer_Utilities::get_terms( 'category' ) ),
			)
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_search_options( $wp_customize ) {
		// Add Homepage/Frontpage Section.
		$wp_customize->add_section( 'jetblack_search',
			array(
				'title' => esc_html__( 'Search', 'jetblack' ),
				'panel' => 'jetblack_theme_options',
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'settings'          => 'jetblack_search_text',
				'sanitize_callback' => 'jetblack_text_sanitization',
				'label'             => esc_html__( 'Search Text', 'jetblack' ),
				'section'           => 'jetblack_search',
				'type'              => 'text',
			)
		);
	}
}

/**
 * Initialize class
 */
$jetblack_theme_options = new JetBlack_Theme_Options();
