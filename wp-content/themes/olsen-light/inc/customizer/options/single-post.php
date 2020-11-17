<?php
$wpc->add_setting( 'single_related_title', array(
	'default'           => esc_html__( 'You may also like', 'olsen-light' ),
	'sanitize_callback' => 'sanitize_text_field',
) );
$wpc->add_control( 'single_related_title', array(
	'type'    => 'text',
	'section' => 'single_post',
	'label'   => esc_html__( 'Related Posts section title', 'olsen-light' ),
) );