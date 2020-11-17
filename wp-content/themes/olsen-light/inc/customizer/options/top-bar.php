<?php
$wpc->add_setting( 'topbar_socials', array(
	'default'           => 1,
	'sanitize_callback' => 'olsen_light_sanitize_checkbox',
) );
$wpc->add_control( 'topbar_socials', array(
	'type'    => 'checkbox',
	'section' => 'top-bar',
	'label'   => __( 'Show social icons.', 'olsen-light' ),
) );