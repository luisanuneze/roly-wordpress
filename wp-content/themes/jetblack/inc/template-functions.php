<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package JetBlack
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function jetblack_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class with respect to layout selected.
	$layout  = jetblack_get_theme_layout();
	$sidebar = jetblack_get_sidebar_id();

	$layout_class = "layout-no-sidebar-content-width";

	if ( 'no-sidebar-full-width' === $layout ) {
		$layout_class = 'layout-no-sidebar-full-width';
	} elseif ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$layout_class = 'layout-right-sidebar';
		}
	}

	$classes[] = $layout_class;

	// Add Site Layout Class.
	$classes[] = esc_attr( jetblack_gtm( 'jetblack_layout_type' ) . '-layout' );

	// Add Archive Layout Class.
	$classes[] = 'grid';

	// Add header Style Class.
	$classes[] = 'header-one';

	// Add Color Scheme Class.
	$jetblack_enable = jetblack_gtm( 'jetblack_header_image_visibility' );

	if ( ! jetblack_display_section( $jetblack_enable ) || ( ! has_header_image() && ! ( is_header_video_active() && has_header_video() ) ) ) {
    	$classes[] = 'no-header-media';
    }

	return $classes;
}
add_filter( 'body_class', 'jetblack_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function jetblack_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'jetblack_pingback_header' );

if ( ! function_exists( 'jetblack_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 */
	function jetblack_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Theme Options
		$length	= jetblack_gtm( 'jetblack_excerpt_length' );

		return absint( $length );
	} // jetblack_excerpt_length.
endif;
add_filter( 'excerpt_length', 'jetblack_excerpt_length', 999 );

if ( ! function_exists( 'jetblack_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
	 *
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function jetblack_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text = jetblack_gtm( 'jetblack_excerpt_more_text' );

		$link = sprintf( '<a href="%1$s" class="more-link"><span class="more-button">%2$s</span></a>',
			esc_url( get_permalink() ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>'
		);

		return '&hellip;' . $link;
	}
endif;
add_filter( 'excerpt_more', 'jetblack_excerpt_more' );

if ( ! function_exists( 'jetblack_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 */
	function jetblack_custom_excerpt( $output ) {
		if ( is_admin() ) {
			return $output;
		}

		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = jetblack_gtm( 'jetblack_excerpt_more_text' );

			$link = sprintf( '<a href="%1$s" class="more-link"><span class="more-button">%2$s</span></a>',
				esc_url( get_permalink() ),
				/* translators: %s: Name of current post */
				wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>'
			);

			$output .= '&hellip;' . $link;
		}

		return $output;
	} // jetblack_custom_excerpt.
endif;
add_filter( 'get_the_excerpt', 'jetblack_custom_excerpt' );

if ( ! function_exists( 'jetblack_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 */
	function jetblack_more_link( $more_link, $more_link_text ) {
		$more_tag_text = jetblack_gtm( 'jetblack_excerpt_more_text' );

		return str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
	} // jetblack_more_link.
endif;
add_filter( 'the_content_more_link', 'jetblack_more_link', 10, 2 );

/**
 * Filter Homepage Options as selected in theme options.
 */
function jetblack_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$cats = jetblack_gtm( 'jetblack_front_page_category' );

		if ( $cats ) {
			$query->query_vars['category__in'] = explode( ',', $cats );
		}
	}
}
add_action( 'pre_get_posts', 'jetblack_alter_home' );

/**
 * Display section as selected in theme options.
 */
function jetblack_display_section( $option ) {
	if ( 'entire-site' === $option || 'custom-pages' === $option || ( is_front_page() && 'homepage' === $option ) || ( ! is_front_page() && 'excluding-home' === $option ) ) {
		return true;
	}

	// Section is disabled.
	return false;
}

/**
 * Return theme layout
 * @return layout
 */
function jetblack_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	}elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = jetblack_gtm( 'jetblack_default_layout' );

		if ( is_home() || is_archive() ) {
			$layout = jetblack_gtm( 'jetblack_homepage_archive_layout' );
		}
	}

	return $layout;
}

/**
 * Return theme layout
 * @return layout
 */
function jetblack_get_sidebar_id() {
	$sidebar = '';

	$layout = jetblack_get_theme_layout();

	if ( 'no-sidebar-full-width' === $layout || 'no-sidebar' === $layout ) {
		return $sidebar;
	}

	$sidebaroptions = '';

	global $post, $wp_query;

	// Front page displays in Reading Settings.
	$page_on_front  = get_option( 'page_on_front' );
	$page_for_posts = get_option( 'page_for_posts' );

	// Get Page ID outside Loop.
	$page_id = $wp_query->get_queried_object_id();
	// Blog Page or Front Page setting in Reading Settings.
	if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
        $sidebaroptions = get_post_meta( $page_id, 'jetblack-sidebar-option', true );
    } elseif ( is_singular() ) {
    	if ( is_attachment() ) {
			$parent 		= $post->post_parent;
			$sidebaroptions = get_post_meta( $parent, 'jetblack-sidebar-option', true );

		} else {
			$sidebaroptions = get_post_meta( $post->ID, 'jetblack-sidebar-option', true );
		}
	}

	return is_active_sidebar( $sidebar ) ? $sidebar : 'sidebar-1'; // sidebar-1 is main sidebar.
}


/**
 * Function to add Scroll Up icon
 */
function jetblack_scrollup() {
	$disable_scrollup = jetblack_gtm( 'jetblack_band_disable_scrollup' );

	if ( $disable_scrollup ) {
		return;
	}

	echo '<a href="#masthead" id="scrollup" class="backtotop">' . '<span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'jetblack' ) . '</span></a>' ;

}
add_action( 'wp_footer', 'jetblack_scrollup', 1 );

/**
 * Return args for specific section type
 */
function jetblack_get_section_args( $section_name ) {
	$numbers = jetblack_gtm( 'jetblack_' . $section_name . '_number' );

	$args = array(
		'ignore_sticky_posts' => 1,
		'posts_per_page'       => absint( $numbers ),
	);

	// If post or page or product, then set post__in argument.
	$post__in = array();

	for( $i = 0; $i < $numbers; $i++ ) {
		$post__in[] = jetblack_gtm( 'jetblack_' . $section_name . '_page_' . $i );
	}

	$args['post__in'] = $post__in;
	$args['orderby']  = 'post__in';

	$args['post_type'] = 'page';

	return $args;
}

/**
 * Button Border Radius CSS.
 */
function jetblack_button_border_radius() {
	$border_radius = jetblack_gtm( 'jetblack_button_border_radius' );

	if ( ! $border_radius ) {
		return;
	}

	$css = '.ff-button, .ff-button:visited, button, a.button, input[type="button"], input[type="reset"], input[type="submit"], .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt { border-radius: ' . esc_attr( $border_radius ) . 'px }';

	wp_add_inline_style( 'jetblack-style', $css );
}
add_action( 'wp_enqueue_scripts', 'jetblack_button_border_radius', 11 );

/**
 * Display content.
 */
function jetblack_display_content( $section ) {
	?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php
}

/**
 * Section class format.
 */
function jetblack_display_section_classes( $classes ) {
	echo esc_attr( implode( ' ', $classes ) );
}

/**
 * Migrate options from free version to pro.
 *
 * @since 1.0
 * @hook after_theme_switch
 */
function ff_nultipurpose_free2pro_migration( $old_theme_name ) {
	if ( $old_theme_name ) {
		$old_theme_slug = sanitize_title( $old_theme_name );

		$free_version_slug = array(
			'jetblack',
		);

		$pro_version_slug  = 'jetblack';

		$free_options = get_option( 'theme_mods_' . $old_theme_slug );

		// Perform action only if theme_mods_solid-construction free version exists.
		if ( in_array( $old_theme_slug, $free_version_slug ) && $free_options && '1' !== get_theme_mod( 'free_pro_migration' ) ) {
			$new_options = wp_parse_args( get_theme_mods(), $free_options );

			if ( update_option( 'theme_mods_' . $pro_version_slug, $new_options ) ) {
				// Set Migration Parameter to true so that this script does not run multiple times.
				set_theme_mod( 'free_pro_migration', '1' );
			}
		}
	}
}
add_action( 'after_switch_theme', 'ff_nultipurpose_free2pro_migration' );
