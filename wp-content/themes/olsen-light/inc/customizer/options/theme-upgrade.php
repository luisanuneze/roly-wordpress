<?php
$wpc->add_setting( 'upgrade_text', array(
	'default' => '',
) );
$wpc->add_control( new Olsen_Light_Customize_Static_Text_Control( $wpc, 'upgrade_text', array(
	'section'     => 'theme_upgrade',
	'label'       => esc_html__( 'Olsen Pro', 'olsen-light' ),
	'description' => array(
		esc_html__( 'Do you enjoy Olsen Light? Upgrade to Pro now and get:', 'olsen-light' ),
		'<ul>' .
		'<li>' . esc_html__( 'Multiple layouts', 'olsen-light' ) . '</li>' .
		'<li>' . esc_html__( 'Infinite style variations', 'olsen-light' ) . '</li>' .
		'<li>' . esc_html__( 'Post formats support', 'olsen-light' ) . '</li>' .
		'<li>' . esc_html__( 'More Customizer options', 'olsen-light' ) . '</li>' .
		'</ul>',
		'<a href="https://www.cssigniter.com/themes/olsen/" class="customizer-link customizer-upgrade">' . esc_html__( 'Upgrade To Pro', 'olsen-light' ) . '</a>',
		'<a href="https://www.cssigniter.com/docs/olsen-light/" class="customizer-link customizer-documentation">' . esc_html__( 'Documentation', 'olsen-light' ) . '</a>'
	),
) ) );