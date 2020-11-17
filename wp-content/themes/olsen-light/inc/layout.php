<?php
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function olsen_light_content_width() {
	$content_width = $GLOBALS['content_width'];

	if ( is_page_template( 'template-builder.php' )	) {
		$content_width = 1010;
	}

	$GLOBALS['content_width'] = apply_filters( 'olsen_light_content_width', $content_width );
}
add_action( 'template_redirect', 'olsen_light_content_width', 0 );

if ( ! function_exists( 'olsen_light_get_layout_classes' ) ) {
	function olsen_light_get_layout_classes( $setting ) {
		$layout            = get_theme_mod( $setting, 'classic_1side' );
		$content_col       = '';
		$sidebar_right_col = '';
		$main_class        = 'entries-classic';
		$post_class        = '';
		$post_col          = '';

		switch ( $layout ) {
			case 'classic_1side':
				$content_col       = 'col-lg-8';
				$sidebar_right_col = 'col-lg-4';
				break;
			case '2cols_side' :
				$content_col       = 'col-lg-8';
				$sidebar_right_col = 'col-lg-4';
				$main_class        = 'entries-grid';
				$post_class        = 'entry-grid';
				$post_col          = 'col-md-6';
				break;
		}

		return array(
			'layout'            => $layout,
			'content_col'       => $content_col,
			'sidebar_right_col' => $sidebar_right_col,
			'main_class'        => $main_class,
			'post_class'        => $post_class,
			'post_col'          => $post_col
		);
	}
}
