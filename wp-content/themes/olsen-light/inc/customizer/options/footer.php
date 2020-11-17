<?php
$wpc->add_setting( 'footer_socials', array(
	'default'           => 1,
	'sanitize_callback' => 'olsen_light_sanitize_checkbox',
) );
$wpc->add_control( 'footer_socials', array(
	'type'    => 'checkbox',
	'section' => 'footer',
	'label'   => esc_html__( 'Show social icons.', 'olsen-light' ),
) );

$wpc->add_setting( 'footer_credits', array(
	'default'           => 1,
	'sanitize_callback' => 'olsen_light_sanitize_checkbox',
) );
$wpc->add_control( 'footer_credits', array(
	'type'    => 'checkbox',
	'section' => 'footer',
	'label'   => esc_html__( 'Show credits text.', 'olsen-light' ),
) );


if ( class_exists( 'Wpzoom_Instagram_Widget' ) ) {
	$wpc->add_setting( 'instagram_auto', array(
		'default'           => 1,
		'sanitize_callback' => 'olsen_light_sanitize_checkbox',
	) );
	$wpc->add_control( 'instagram_auto', array(
		'type'    => 'checkbox',
		'section' => 'footer',
		'label'   => esc_html__( 'Enable Instagram slideshow auto slide.', 'olsen-light' ),
	) );

	$wpc->add_setting( 'instagram_speed', array(
		'default'           => 300,
		'sanitize_callback' => 'olsen_light_sanitize_intval_or_empty',
	) );
	$wpc->add_control( 'instagram_speed', array(
		'type'    => 'number',
		'section' => 'footer',
		'label'   => esc_html__( 'Instagram Slideshow Speed.', 'olsen-light' ),
	) );
}