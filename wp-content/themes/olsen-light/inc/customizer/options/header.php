<?php
$wpc->add_setting( 'header_socials', array(
	'default'           => 1,
	'sanitize_callback' => 'olsen_light_sanitize_checkbox',
) );
$wpc->add_control( 'header_socials', array(
	'type'    => 'checkbox',
	'section' => 'header',
	'label'   => esc_html__( 'Show social icons.', 'olsen-light' ),
) );

$wpc->add_setting( 'header_searchform', array(
	'default'           => 0,
	'sanitize_callback' => 'olsen_light_sanitize_checkbox',
) );
$wpc->add_control( 'header_searchform', array(
	'type'    => 'checkbox',
	'section' => 'header',
	'label'   => __( 'Show search form.', 'olsen-light' ),
) );