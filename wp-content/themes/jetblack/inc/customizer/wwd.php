<?php
/**
 * WWD Options
 *
 * @package JetBlack
 */

class JetBlack_WWD_Options {
	public function __construct() {
		// Register WWD Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'jetblack_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'jetblack_wwd_visibility'   => 'disabled',
			'jetblack_wwd_number'       => 6,
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
				'settings'          => 'jetblack_wwd_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'jetblack_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'jetblack' ),
				'section'           => 'jetblack_ss_wwd',
				'choices'           => JetBlack_Customizer_Utilities::section_visibility(),
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'jetblack_text_sanitization',
				'settings'          => 'jetblack_wwd_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'jetblack' ),
				'section'           => 'jetblack_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'settings'          => 'jetblack_wwd_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'jetblack_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'jetblack' ),
				'section'           => 'jetblack_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'settings'          => 'jetblack_wwd_section_subtitle',
				'type'              => 'text',
				'sanitize_callback' => 'jetblack_text_sanitization',
				'label'             => esc_html__( 'Section Subtitle', 'jetblack' ),
				'section'           => 'jetblack_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'settings'          => 'jetblack_wwd_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'jetblack' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'jetblack' ),
				'section'           => 'jetblack_ss_wwd',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		JetBlack_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'JetBlack_Simple_Notice_Custom_Control',
				'sanitize_callback' => 'sanitize_text_field',
				'settings'          => 'jetblack_wwd_icon_note',
				'label'             =>  esc_html__( 'Info', 'jetblack' ),
				'description'       =>  sprintf( esc_html__( 'If you want camera icon, save "fas fa-camera". For more classes, check %1$sthis%2$s', 'jetblack' ), '<a href="' . esc_url( 'https://fontawesome.com/icons?d=gallery&m=free' ) . '" target="_blank">', '</a>' ),
				'section'           => 'jetblack_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		$numbers = jetblack_gtm( 'jetblack_wwd_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			JetBlack_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'JetBlack_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'jetblack_text_sanitization',
					'settings'          => 'jetblack_wwd_notice_' . $i,
					'label'             => esc_html__( 'Item #', 'jetblack' )  . $j,
					'section'           => 'jetblack_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);

			JetBlack_Customizer_Utilities::register_option(
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'jetblack_wwd_custom_icon_' . $i,
					'label'             => esc_html__( 'Icon Class', 'jetblack' ),
					'section'           => 'jetblack_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);

			JetBlack_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'JetBlack_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'jetblack_wwd_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'jetblack' ),
					'section'           => 'jetblack_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
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
	 * WWD visibility active callback.
	 */
	public function is_wwd_visible( $control ) {
		return ( jetblack_display_section( $control->manager->get_setting( 'jetblack_wwd_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$jetblack_ss_wwd = new JetBlack_WWD_Options();
