<?php
$choices = array(
	'classic_1side'       => _x( 'Classic - One Sidebar', 'page layout', 'olsen-light' ),
	'2cols_side'          => _x( 'Two columns - Sidebar', 'page layout', 'olsen-light' ),
);
$wpc->add_setting( 'layout_blog', array(
	'default'           => 'classic_1side',
	'sanitize_callback' => 'olsen_light_sanitize_blog_terms_layout',
) );
$wpc->add_control( 'layout_blog', array(
	'type'        => 'select',
	'section'     => 'layout',
	'label'       => __( 'Blog layout', 'olsen-light' ),
	'description' => __( 'Applies to the home page and blog-related pages.', 'olsen-light' ),
	'choices'     => $choices,
) );

$wpc->add_setting( 'layout_terms', array(
	'default'           => 'classic_1side',
	'sanitize_callback' => 'olsen_light_sanitize_blog_terms_layout',
) );
$wpc->add_control( 'layout_terms', array(
	'type'        => 'select',
	'section'     => 'layout',
	'label'       => __( 'Categories and Tags layout', 'olsen-light' ),
	'description' => __( 'Applies to the categories and tags listing pages.', 'olsen-light' ),
	'choices'     => $choices,
) );

$wpc->add_setting( 'excerpt_length', array(
	'default'           => 55,
	'sanitize_callback' => 'absint',
) );
$wpc->add_control( 'excerpt_length', array(
	'type'        => 'number',
	'input_attrs' => array(
		'min'  => 10,
		'step' => 1,
	),
	'section'     => 'layout',
	'label'       => esc_html__( 'Automatically generated excerpt length (in words)', 'olsen-light' ),
) );

$wpc->add_setting( 'excerpt_on_classic_layout', array(
	'default'           => '',
	'sanitize_callback' => 'olsen_light_sanitize_checkbox',
) );
$wpc->add_control( 'excerpt_on_classic_layout', array(
	'type'    => 'checkbox',
	'section' => 'layout',
	'label'   => esc_html__( 'Display the excerpt instead of the content.', 'olsen-light' ),
) );

$wpc->add_setting( 'pagination_method', array(
	'default'           => 'numbers',
	'sanitize_callback' => 'olsen_light_sanitize_pagination_method',
) );
$wpc->add_control( 'pagination_method', array(
	'type'    => 'select',
	'section' => 'layout',
	'label'   => esc_html__( 'Pagination method', 'olsen-light' ),
	'choices' => array(
		'numbers' => esc_html_x( 'Numbered links', 'pagination method', 'olsen-light' ),
		'text'    => esc_html_x( '"Previous - Next" links', 'pagination method', 'olsen-light' ),
	),
) );

$wpc->add_setting( 'blog_related', array(
	'default'           => 0,
	'sanitize_callback' => 'olsen_light_sanitize_checkbox',
) );
$wpc->add_control( 'blog_related', array(
	'type'    => 'checkbox',
	'section' => 'layout',
	'label'   => __( 'Show related posts in blog listing. Applies to classic layouts only.', 'olsen-light' ),
) );

$wpc->add_setting( 'blog_related_title', array(
	'default'           => __( 'You may also like', 'olsen-light' ),
	'sanitize_callback' => 'sanitize_text_field',
) );
$wpc->add_control( 'blog_related_title', array(
	'type'    => 'text',
	'section' => 'layout',
	'label'   => __( 'Blog Related Posts section title.', 'olsen-light' ),
) );