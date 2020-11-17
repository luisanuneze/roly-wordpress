<?php
add_action( 'widgets_init', 'olsen_light_widgets_init' );
function olsen_light_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html_x( 'Blog', 'widget area', 'olsen-light' ),
		'id'            => 'blog',
		'description'   => esc_html__( 'This is the main sidebar.', 'olsen-light' ),
		'before_widget' => '<aside id="%1$s" class="widget group %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html_x( 'Pages', 'widget area', 'olsen-light' ),
		'id'            => 'page',
		'description'   => esc_html__( 'This sidebar appears on your static pages. If empty, the Blog sidebar will be shown instead.', 'olsen-light' ),
		'before_widget' => '<aside id="%1$s" class="widget group %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html_x( 'Footer Sidebar', 'widget area', 'olsen-light' ),
		'id'            => 'footer-widgets',
		'description'   => esc_html__( 'Special site-wide sidebar for the WP Instagram Widget plugin.', 'olsen-light' ),
		'before_widget' => '<aside id="%1$s" class="widget group %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'olsen_light_load_widgets' );
function olsen_light_load_widgets() {
	require get_template_directory() . '/inc/widgets/about-me.php';
	require get_template_directory() . '/inc/widgets/latest-posts.php';
	require get_template_directory() . '/inc/widgets/socials.php';
}