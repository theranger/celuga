<?php
/**
 * beluga functions and definitions
 *
 * @package beluga
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
	$content_width = 640; /* pixels */
}

if (!function_exists('beluga_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function beluga_setup()
	{

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on beluga, use a find and replace
		 * to change 'beluga' to the name of your theme in all the template files
		 */
		load_theme_textdomain('beluga', get_template_directory() . '/languages');

		add_editor_style("editor.css");
		add_editor_style(array('editor-style.css', beluga_fonts_url()));
		add_theme_support('automatic-feed-links');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(680, 300, true);
		add_image_size('featured-image', 1600, 250, true);
		update_option('medium_size_w', 640);
		update_option('medium_size_h', 640);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'primary' => __('Primary Menu', 'beluga'),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		));

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support('post-formats', array(
			'aside', 'status', 'image', 'video', 'audio', 'quote'
		));

		// Setup the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('beluga_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));
	}
endif; // beluga_setup
add_action('after_setup_theme', 'beluga_setup');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function beluga_widgets_init()
{
	register_sidebar(array(
		'name' => __('First Sidebar', 'beluga'),
		'id' => 'sidebar-1',
		'description' => 'Sits in the pulldown menu, on the left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => __('Second Sidebar', 'beluga'),
		'id' => 'sidebar-2',
		'description' => 'Sits in the pulldown menu, in the center',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => __('Third Sidebar', 'beluga'),
		'id' => 'sidebar-3',
		'description' => 'Sits in the pulldown menu, on the right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}

add_action('widgets_init', 'beluga_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function beluga_scripts()
{
	$options = get_option('beluga_theme_settings');
	if (!empty($options['header_opacity'])) {
		$o = $options['header_opacity'];
	} else {
		$o = '0';
	}

	wp_enqueue_style('theme-slug-fonts', beluga_fonts_url(), array(), null);
	wp_enqueue_style('beluga-style', get_stylesheet_uri());
	wp_enqueue_style('genericons', get_template_directory_uri() . '/css/genericons.css');

	wp_enqueue_script('beluga-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '2014', true);
	wp_enqueue_script('beluga-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);
	wp_enqueue_script('waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), '2014', true);
	wp_enqueue_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '2014', true);

	wp_localize_script('beluga-navigation', 'belugaOptions', array('headerOpacity' => $o));

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}

add_action('wp_enqueue_scripts', 'beluga_scripts');

function beluga_fonts_url()
{
	$fonts_url = '';

	$open_sans = _x('on', 'Open Sans font: on or off', 'beluga'); //turn 'off' for languages with characters not supported by 'Open Sans'
	if ('off' !== $open_sans) {
		$font_family = 'Open Sans:400,300,600,700,800';
		$query_args = array('family' => urlencode($font_family),
			'subset' => urlencode('latin,latin-ext'));
		$fonts_url = add_query_arg($query_args, '//fonts.googleapis.com/css');
	}

	return $fonts_url;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
