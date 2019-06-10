<?php
/**
 * wp-commerce functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP Commerce
 */
define('wp_commerce_VERSION','1.0.0');

$template_directory = trailingslashit( get_template_directory() );
if ( ! function_exists( 'wp_commerce_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wp_commerce_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wp-commerce, use a find and replace
		 * to change 'wp-commerce' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wp-commerce', get_template_directory() . '/languages' );

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
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'wp-commerce-product-thumbs-168-*-168', 160,160,true);
		add_image_size( 'wp-commerce-service-thumbs-98-*-64', 98,64,true);
		add_image_size( 'wp-commerce-news-thumbs-348-*-212', 348,212,true);
		add_image_size( 'wp-commerce-mini-cart-thumb-80*-80', 80,80,true);
		add_image_size( 'wp-commerce-banner-thumb-730*-368', 730,369,true);
		add_image_size( 'wp-commerce-single-product_related-thumb-109*-109', 109,109,true);
		add_image_size( 'wp-commerce-single-product-thumb-379*-379', 379,379,true);
		add_image_size( 'wp-commerce-blog-thumb', 350,213,true);
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Main menu', 'wp-commerce' ),
			'footer-1' => esc_html__( 'Footer Top Menu', 'wp-commerce'),
			'footer-2' => esc_html__( 'Footer Menu', 'wp-commerce')
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wp_commerce_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Woocommerce Support
		add_theme_support( 'woocommerce' );
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'wp_commerce_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_commerce_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'wp_commerce_content_width', 640 );
}
add_action( 'after_setup_theme', 'wp_commerce_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
require $template_directory.'/inc/enqueue.php';

/**
 * Implement the Custom Header feature.
 */
require $template_directory.'/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require $template_directory.'/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require $template_directory.'/inc/template-functions.php';

/*
* Widgets Register
*/
require $template_directory.'/inc/widgets/wc-widget-functions.php';

/**
 * Customizer additions.
 */
require $template_directory.'/inc/customizer/customizer.php';


/*
* Customizer Css
*/
require $template_directory.'/inc/customizer/customizer-css.php';



/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

add_action('wp_enqueue_scripts', 'woocommerce_register_javascript', 100);

function woocommerce_register_javascript() {
  wp_register_script('mediaelement', plugins_url('wp-mediaelement.min.js', __FILE__), array('jquery'), '4.8.2', true);
  wp_enqueue_script('mediaelement');
}

add_filter('wp_commerce_shopping_cart','wp_commerce_add_cart_single_ajax', 10, 2);

function wp_commerce_add_cart_single_ajax() {
	$html = '';
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
		ob_start();
		the_widget( 'WC_Widget_Cart' );
		$html = ob_get_clean();
	}
	return $html;
}

/*
*Bootstrap Navigation
*/
require get_template_directory() . '/inc/wp-bootstrap-navwalker.php';

add_filter('walker_nav_menu_start_el', 'wp_commerce_walker_nav_menu_start_el', 10, 4);

function wp_commerce_walker_nav_menu_start_el($item_output, $item, $depth = 0, $args = array(), $id = 0) 
{
    if ( $depth == 0 ) {
        $item_output = preg_replace('/<a /', '<a class="nav-link" ', $item_output, 1);
    } elseif( $depth > 0 ){
        $item_output = preg_replace('/<a /', '<a class="dropdown-item" ', $item_output, 1);
    }
    return $item_output;
}

if ( is_admin() ) {
	// Load about.
	require_once trailingslashit( get_template_directory() ) . '/inc/theme-info/class-about.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/theme-info/about.php';

	// Load demo.
	require_once trailingslashit( get_template_directory() ) . '/inc/demo/class-demo.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/demo/demo.php';
}


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require $template_directory.'/inc/jetpack.php';
}

