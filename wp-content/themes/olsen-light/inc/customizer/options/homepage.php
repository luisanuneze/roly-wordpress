<?php
$wpc->add_control( new Olsen_Light_Customize_Slick_Control( $wpc, 'home_slider', array(
	'section'     => 'homepage',
	'label'       => __( 'Home Slider', 'olsen-light' ),
	'description' => __( 'Fine-tune the homepage slider.', 'olsen-light' ),
), array(
	'taxonomy' => 'category',
) ) );