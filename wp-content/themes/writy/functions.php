<?php


if (!function_exists('writy_setup_theme')) :
    function writy_setup_theme()
    {
        load_theme_textdomain('writy', get_template_directory() . '/languages');
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        // Custom background color.
        add_theme_support('custom-background', apply_filters('writy_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');
        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');
        // Gutenberg Support
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'top_menu' => esc_html__('Header Menu', 'writy'),
        ));
        register_nav_menus(array(
            'footer_menu' => esc_html__('Footer Menu', 'writy'),
        ));
        /*main-menu
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
        add_image_size('writy_banner_image', 1110, 442, true);
        add_image_size('writy_blog_page_image', 795, 419, true);
        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height'      => 100,
            'width'       => 100,
            'flex-width'  => true,
            'flex-height' => true,
        ));
        $args = array(
            'default-image'      => '',
            'width'              => 1000,
            'height'             => 125,
            'flex-width'         => true,
            'flex-height'        => true,
        );
        //add_theme_support('custom-header', $args);
        // Add support for full and wide align images.
        add_theme_support('align-wide');
    }
endif;
add_action('after_setup_theme', 'writy_setup_theme');

function writy_classic_editor_style()
{

    $classic_editor_styles = array(
        'style-editor.css',
    );

    add_editor_style($classic_editor_styles);
}

add_action('admin_init', 'writy_classic_editor_style');

function writy_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('writy_content_width', 640);
}
add_action('after_setup_theme', 'writy_content_width', 0);

function writy_widget_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'writy'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'writy'),
        'before_widget' => '<div id="%1$s" class="writy_blog_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class=" title-line">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'writy_widget_init');
/**
 * Enqueue scripts and styles.
 */
function writy_script()
{
    wp_enqueue_style( 'writy-google-fonts', 'https://fonts.googleapis.com/css?family=Alegreya:400,500,700&display=swap', false );
    wp_enqueue_style('writy-theme-roots', get_theme_file_uri('/assets/css/themeroots.min.css'), null, '1.0');
    wp_enqueue_style('writy-style', get_stylesheet_uri());

    wp_enqueue_script('writy-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array('jquery'), '1.00', true);

    wp_enqueue_script('writy-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.00', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'writy_script');
/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function writy_skip_link()
{
    echo '<a class="skip-link screen-reader-text" href="#site-content">' . __('Skip to the content', 'writy') . '</a>';
}

add_action('wp_body_open', 'writy_skip_link', 5);

function writy_midsize($size)
{
    return 5;
}
add_filter('writy_midsize', 'writy_midsize');


function writy_add_class_on_li($items)
{
    $parents = array();

    // Collect menu items with parents.
    foreach ($items as $item) {
        if ($item->menu_item_parent && $item->menu_item_parent > 0) {
            $parents[] = $item->menu_item_parent;
        }
    }

    // Add class.
    foreach ($items as $item) {
        if (in_array($item->ID, $parents)) {
            $item->classes[] = 'has-dropdown'; //here attach the class
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'writy_add_class_on_li');

// Load Dash Icon 
add_action('wp_enqueue_scripts', 'writy_load_dashicon');
function writy_load_dashicon()
{
    wp_enqueue_style('dashicons');
}

function writy_searchform($form)
{
    $home_url = home_url('/');
    $label = __('Search for:', 'writy');
    $button_name = __('Search', 'writy');
    $newform = '<form role="search" method="get" class="writy_search" action="'. esc_attr($home_url).'">
        <label>
            <input type="'. esc_attr($button_name).'" class="search-field" placeholder="'.__('Type Keywords','writy').'" value="" name="s"  autocomplete="off">
        </label>
        <input type="hidden" name="post_type" value="post">
        <input type="submit" class="search-submit" value="' . esc_attr($button_name).'">
    </form>';

    return $newform;
}
add_action('get_search_form', 'writy_searchform');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

// Handle Customizer settings.
require get_template_directory() . '/classes/class-writy-customizer.php';
