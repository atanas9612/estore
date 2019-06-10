<?php
/**
 * Files to managed the all function related to widgets
 *
 * @package WP Commerce
 * @since 1.0.0
 *
 */

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_commerce_widgets_init() {
	
	/**
	 * register default sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wp-commerce' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wp-commerce' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s blog-categories">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="main-title"><h6 class="widget-title">',
		'after_title'   => '</h6></div>',
	) );

	/**
	 * register Shop sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'wp-commerce' ),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'wp-commerce' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s blog-categories">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="main-title"><h6 class="widget-title">',
		'after_title'   => '</h6></div>',
	) );

	/**
	 * register Frontpage Feature Products Widget
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Frontpage Feature Products Section', 'wp-commerce' ),
		'id'            => 'feature-product',
		'description'   => esc_html__( 'Add widgets here.', 'wp-commerce' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * register Frontpage News Arrivals widgets
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Frontpage News Arrivals Section', 'wp-commerce' ),
		'id'            => 'new-arrivals',
		'description'   => esc_html__( 'Add widgets here.', 'wp-commerce' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * register Frontpage Hot Products widgets
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Frontpage Hot Products Section', 'wp-commerce' ),
		'id'            => 'hot-products',
		'description'   => esc_html__( 'Add widgets here.', 'wp-commerce' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wp_commerce_widgets_init' );
/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Register various widgets
 *
 * @since 1.0.0
 */

function wp_commerce_register_grid_layout_widget() {

    if( wp_commerce_is_woocommerce_activated() ) {
    	// Featured Products
    	register_widget( 'WP_Commerce_Featured_Products' );

    	// New Arrival Products
    	register_widget( 'WP_Commerce_New_Arrival_Products' );

    	// Hot Products
    	register_widget( 'WP_Commerce_Hot_Products' );
    }
}

add_action( 'widgets_init', 'wp_commerce_register_grid_layout_widget' );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Load important files for widgets
 *
 * @since 1.0.0
 */
require get_template_directory() . '/inc/widgets/wc-widget-fields.php';

if( wp_commerce_is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/widgets/wc-featured-products.php';
	require get_template_directory() . '/inc/widgets/wc-new-arrival-products.php';
	require get_template_directory() . '/inc/widgets/wc-hot-products.php';
}