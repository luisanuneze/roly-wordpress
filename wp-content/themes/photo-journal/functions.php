<?php
/**
 * Photo Journal functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package Photo_Journal
 */

/**
 * Photo Journal only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require trailingslashit( get_template_directory() ) . 'inc/back-compat.php';
}

if ( ! function_exists( 'photo_journal_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own photo_journal_setup() function to override in a child theme.
 *
 * @since Photo Journal 0.1
 */
function photo_journal_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/photoJournal
	 * If you're building a theme based on Photo Journal, use a find and replace
	 * to change 'photo-journal' to the name of your theme in all the template files
	 */
	load_theme_textdomain('photo-journal', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Photo Journal 0.1
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
		'flex-width'  => true,
	) );


	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add custom editor font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => esc_html__( 'Small', 'photo-journal' ),
				'shortName' => esc_html__( 'S', 'photo-journal' ),
				'size'      => 14,
				'slug'      => 'small',
			),
			array(
				'name'      => esc_html__( 'Normal', 'photo-journal' ),
				'shortName' => esc_html__( 'M', 'photo-journal' ),
				'size'      => 18,
				'slug'      => 'normal',
			),
			array(
				'name'      => esc_html__( 'Large', 'photo-journal' ),
				'shortName' => esc_html__( 'L', 'photo-journal' ),
				'size'      => 46,
				'slug'      => 'large',
			),
			array(
				'name'      => esc_html__( 'Huge', 'photo-journal' ),
				'shortName' => esc_html__( 'XL', 'photo-journal' ),
				'size'      => 60,
				'slug'      => 'huge',
			),
		)
	);

	// Add support for custom color scheme.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => esc_html__( 'White', 'photo-journal' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html__( 'Black', 'photo-journal' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
		array(
			'name'  => esc_html__( 'Medium Black', 'photo-journal' ),
			'slug'  => 'medium-black',
			'color' => '#222222',
		),
		array(
			'name'  => esc_html__( 'Gray', 'photo-journal' ),
			'slug'  => 'gray',
			'color' => '#afafaf',
		),
		array(
			'name'  => esc_html__( 'Pink', 'photo-journal' ),
			'slug'  => 'pink',
			'color' => '#5f4b8b',
		),
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Used in Homepage Content, 3:2 Ratio
	set_post_thumbnail_size( 990, 660, false );

	// Used in Featured Slider, Promotion Headline, 21:9 Ratio
	add_image_size( 'photo-journal-slider', 1920, 1080, true );

	// Used in Featured Content 4:3 Ratio
	add_image_size( 'photo-journal-featured-content', 606, 455, true );

	// Used in Hero Content, 4:3 ratio
	add_image_size( 'photo-journal-hero-content', 730, 547, true );

	//Used in Team Section , 3:4 ratio
	add_image_size( 'photo-journal-team', 606, 808, true );

	// Used in Events Section, 1:1 ratio
	add_image_size( 'photo-journal-events', 50, 50, true );

	//Used in Countdown, 1:1 ratio
	add_image_size( 'photo-journal-countdown', 606, 606, true );

	// Used in Header Image for single pages
	add_image_size( 'photo-journal-header-image', 1920, 400, true );

	// Used in Logo Slider, 5:4 ratio
	add_image_size( 'photo-journal-logo-slider', 226, 180, true );

	// Used in Testimonials, 1:1 ratio
	add_image_size( 'photo-journal-testimonial', 150, 150, true );

	// Used in Portfolio, Flexible Height
	add_image_size( 'photo-journal-portfolio', 606, 999, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'menu-1'        => esc_html__( 'Primary Menu', 'photo-journal' ),
		'social-header' => esc_html__( 'Social Header Menu', 'photo-journal' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css', photo_journal_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add Support for Sticky Menu.
	 */
	add_theme_support( 'catch-sticky-menu', apply_filters( 'photo_journal_sticky_menu_args', array(
		'sticky_desktop_menu_selector' => '#site-header-menu',
		'sticky_mobile_menu_selector'  => '#header-navigation-area .wrapper',
		'sticky_background_color'      => '#ffffff',
	) ) );
}
endif; // photo_journal_setup
add_action( 'after_setup_theme', 'photo_journal_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Photo Journal 0.1
 */
function photo_journal_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'photo_journal_content_width', 990 );
}
add_action( 'after_setup_theme', 'photo_journal_content_width', 0 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
 *
 * @global int $content_width
 */
function photo_journal_template_redirect() {
    $layout = photo_journal_get_theme_layout();
}
add_action( 'template_redirect', 'photo_journal_template_redirect' );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Photo Journal 0.1
 */
function photo_journal_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'photo-journal' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'photo-journal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'photo-journal' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'photo-journal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'photo-journal' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'photo-journal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'photo-journal' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'photo-journal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//Instagram Widget
	if ( class_exists( 'Catch_Instagram_Feed_Gallery_Widget' ) ||  class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Instagram', 'photo-journal' ),
			'id'            => 'sidebar-instagram',
			'description'   => esc_html__( 'Appears above footer. This sidebar is only for Widget from plugin Catch Instagram Feed Gallery Widget and Catch Instagram Feed Gallery Widget Pro', 'photo-journal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'photo_journal_widgets_init' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Photo Journal 0.1
 */
function photo_journal_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="widget-area footer-widget-area ' . $class . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped.
}

if ( ! function_exists( 'photo_journal_fonts_url' ) ) :
/**
 * Register Google fonts for Photo Journal Pro
 *
 * Create your own photo_journal_fonts_url() function to override in a child theme.
 *
 * @since Photo Journal 0.1
 *
 * @return string Google fonts URL for the theme.
 */
function photo_journal_fonts_url() {
	$fonts_url = '';
	/* Translators: If there are characters in your language that are not
		* supported by Josefin Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$josefin_sans = _x( 'on', 'Josefin Sans: on or off', 'photo-journal' );

		/* Translators: If there are characters in your language that are not
		* supported by Great Vibes, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$great_vibes = _x( 'on', 'Great Vibes: on or off', 'photo-journal' );

		if ( 'off' !== $josefin_sans || 'off' !== $great_vibes ) {
			$font_families = array();

			if ( 'off' !== $josefin_sans ) {
			$font_families[] = 'Josefin Sans::300,400,600,700';
			}

			if ( 'off' !== $great_vibes ) {
			$font_families[] = 'Great Vibes::300,400,600,700';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Photo Journal 0.1
 */
function photo_journal_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'photo_journal_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Photo Journal 0.1
 */
function photo_journal_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'photo-journal-fonts', photo_journal_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'photo-journal-style', get_stylesheet_uri(), null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );

	// Theme block stylesheet.
	wp_enqueue_style( 'photo-journal-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'photo-journal-style' ), '1.0' );

	// Load the html5 shiv.
	wp_enqueue_script( 'photo-journal-html5', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'photo-journal-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'photo-journal-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/skip-link-focus-fix.min.js', array(), '20181115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'photo-journal-keyboard-image-navigation', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/keyboard-image-navigation.min.js', array( 'jquery' ), '20181115' );
	}

	// Enqueue fitvid
		wp_register_script( 'jquery-fitvids', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/fitvids.min.js', array( 'jquery' ), '1.1', true );

		$deps[] = 'jquery-fitvids';

 	wp_register_script( 'jquery-match-height', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.matchHeight.min.js', array( 'jquery' ), '20181115', true );

 	$deps[] = 'jquery-match-height';

	// Add masonry to dependent scripts of main script.
	$deps[] = 'jquery-masonry';

	wp_enqueue_script( 'photo-journal-script', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/functions.min.js', $deps, '20181115', true );

	wp_localize_script( 'photo-journal-script', 'photoJournalScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'photo-journal' ),
		'collapse' => esc_html__( 'collapse child menu', 'photo-journal' ),
		'icon'     => photo_journal_get_svg( array(
			'icon'     => 'angle-down',
			'fallback' => true,
		) ),
	) );

	// Slider Scripts.
	$enable_slider = get_theme_mod( 'photo_journal_slider_option', 'disabled' );
	$enable_testimonial = get_theme_mod( 'photo_journal_testimonial_option', 'diabled' );

	if ( photo_journal_check_section( $enable_slider ) || photo_journal_check_section( $enable_testimonial ) ) {
		wp_enqueue_script( 'jquery-cycle2', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );
	}
}
add_action( 'wp_enqueue_scripts', 'photo_journal_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 */
function photo_journal_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'photo-journal-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/css/editor-blocks.css' );
	// Add custom fonts.
	wp_enqueue_style( 'photo-journal-fonts', photo_journal_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'photo_journal_block_editor_styles' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( 'inc/template-tags.php' );

/**
 * Add theme admin page.
 */
if ( is_admin() ) {
	require get_parent_theme_file_path( 'inc/about.php' );
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Include Header Background Color Options
 */
require get_parent_theme_file_path( 'inc/color-scheme.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( 'inc/icon-functions.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_parent_theme_file_path( 'inc/extras.php' );

/**
 * Add functions for header media.
 */
require get_parent_theme_file_path( 'inc/custom-header.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_parent_theme_file_path( 'inc/jetpack.php' );

/**
 * Include Slider
 */
require get_parent_theme_file_path( '/inc/featured-slider.php' );

/**
 * Include Service
 */
require get_parent_theme_file_path( '/inc/service.php' );

/**
 * Include Widgets
 */
require get_parent_theme_file_path( '/inc/widgets/social-icons.php' );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Photo Journal 0.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function photo_journal_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'photo_journal_widget_tag_cloud_args' );

/**
 * Load TGMPA
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function photo_journal_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// Catch Web Tools.
		array(
			'name' => 'Catch Web Tools', // Plugin Name, translation not required.
			'slug' => 'catch-web-tools',
		),
		// Catch IDs
		array(
			'name' => 'Catch IDs', // Plugin Name, translation not required.
			'slug' => 'catch-ids',
		),
		// To Top.
		array(
			'name' => 'To top', // Plugin Name, translation not required.
			'slug' => 'to-top',
		),
		// Catch Gallery.
		array(
			'name' => 'Catch Gallery', // Plugin Name, translation not required.
			'slug' => 'catch-gallery',
		),
	);

	if ( ! class_exists( 'Catch_Infinite_Scroll_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Infinite Scroll', // Plugin Name, translation not required.
			'slug' => 'catch-infinite-scroll',
		);
	}

	if ( ! class_exists( 'Essential_Content_Types_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Content Types', // Plugin Name, translation not required.
			'slug' => 'essential-content-types',
		);
	}

	if ( ! class_exists( 'Essential_Widgets_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Widgets', // Plugin Name, translation not required.
			'slug' => 'essential-widgets',
		);
	}

	if ( ! class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Instagram Feed Gallery & Widget', // Plugin Name, translation not required.
			'slug' => 'catch-instagram-feed-gallery-widget',
		);
	}

	if ( ! class_exists( 'Catch_Breadcrumb_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Breadcrumb', // Plugin Name, translation not required.
			'slug' => 'catch-breadcrumb',
		);
	}

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'photo-journal',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'photo_journal_register_required_plugins' );
