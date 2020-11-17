<?php
/**
 * Slider Options
 *
 * @package JetBlack
 */

class JetBlack_Slider_Options {
	public function __construct() {
		// Register Slider Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 98 );

		// Add default options.
		add_filter( 'jetblack_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'jetblack_slider_visibility' => 'disabled',
			'jetblack_slider_number'     => 2,
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add slider section and its controls
	 */
	public function register_options( $wp_customize ) {
		JetBlack_Customizer_Utilities::register_option(
			array(
				'settings'          => 'jetblack_slider_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'jetblack_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'jetblack' ),
				'section'           => 'jetblack_ss_slider',
				'choices'           => JetBlack_Customizer_Utilities::section_visibility(),
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'jetblack_slider_number',
				'label'             => esc_html__( 'Number', 'jetblack' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'jetblack' ),
				'section'           => 'jetblack_ss_slider',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		$numbers = jetblack_gtm( 'jetblack_slider_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			JetBlack_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'JetBlack_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'jetblack_text_sanitization',
					'settings'          => 'jetblack_slider_notice_' . $i,
					'label'             => esc_html__( 'Item #', 'jetblack' )  . $j,
					'section'           => 'jetblack_ss_slider',
					'active_callback'   => array( $this, 'is_slider_visible' ),
				)
			);

			JetBlack_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'JetBlack_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'jetblack_slider_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'jetblack' ),
					'section'           => 'jetblack_ss_slider',
					'active_callback'   => array( $this, 'is_slider_visible' ),
					'input_attrs' => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);
		}
	}

	/**
	 * Slider visibility active callback.
	 */
	public function is_slider_visible( $control ) {
		return ( jetblack_display_section( $control->manager->get_setting( 'jetblack_slider_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$slider_ss_slider = new JetBlack_Slider_Options();
