<?php
/**
 * Testimonial Options
 *
 * @package JetBlack
 */

class JetBlack_Testimonial_Options {
	public function __construct() {
		// Register Testimonial Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'jetblack_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'jetblack_testimonial_visibility' => 'disabled',
			'jetblack_testimonial_number'     => 4,
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_options( $wp_customize ) {
		JetBlack_Customizer_Utilities::register_option(
			array(
				'settings'          => 'jetblack_testimonial_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'jetblack_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'jetblack' ),
				'section'           => 'jetblack_ss_testimonial',
				'choices'           => JetBlack_Customizer_Utilities::section_visibility(),
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'jetblack_text_sanitization',
				'settings'          => 'jetblack_testimonial_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'jetblack' ),
				'section'           => 'jetblack_ss_testimonial',
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'settings'          => 'jetblack_testimonial_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'jetblack_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'jetblack' ),
				'section'           => 'jetblack_ss_testimonial',
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'settings'          => 'jetblack_testimonial_section_subtitle',
				'type'              => 'text',
				'sanitize_callback' => 'jetblack_text_sanitization',
				'label'             => esc_html__( 'Section Subtitle', 'jetblack' ),
				'section'           => 'jetblack_ss_testimonial',
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);


		JetBlack_Customizer_Utilities::register_option(
			array(
				'settings'          => 'jetblack_testimonial_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'jetblack' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'jetblack' ),
				'section'           => 'jetblack_ss_testimonial',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);

		$numbers = jetblack_gtm( 'jetblack_testimonial_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			JetBlack_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'JetBlack_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'jetblack_testimonial_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'jetblack' ),
					'section'           => 'jetblack_ss_testimonial',
					'active_callback'   => array( $this, 'is_testimonial_visible' ),
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
	 * Testimonial visibility active callback.
	 */
	public function is_testimonial_visible( $control ) {
		return ( jetblack_display_section( $control->manager->get_setting( 'jetblack_testimonial_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$jetblack_ss_testimonial = new JetBlack_Testimonial_Options();
