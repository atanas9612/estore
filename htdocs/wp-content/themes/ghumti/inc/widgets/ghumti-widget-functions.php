<?php
/**
 * Ghumti custom function and work related to widgets.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ghumti_widgets_init() {
	
	/**
	 * Register right sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ghumti' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ghumti' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register left sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'ghumti' ),
		'id'            => 'ghumti_left_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'ghumti' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register home middle section area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Middle Section', 'ghumti' ),
		'id'            => 'ghumti_home_middle_section_area',
		'description'   => esc_html__( 'This only works if you set a static home page, and select the provided homepage template as page template.', 'ghumti' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="ghumti-block-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	/**
	 * Register Top footer different footer area 
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer', 'ghumti' ),
		'id'            => 'ghumti_top_footer',
		'description'   => esc_html__( 'Added widgets are display at Top Footer Widget Area.', 'ghumti' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register Main footer different footer area 
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Main Footer', 'ghumti' ),
		'id'            => 'ghumti_main_footer',
		'description'   => esc_html__( 'Added widgets are display at Main Footer Widget Area.', 'ghumti' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'ghumti_widgets_init' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register different widgets
 *
 * @since 1.0.1
 */
add_action( 'widgets_init', 'ghumti_register_widgets' );

function ghumti_register_widgets() {

	// Block Posts
	register_widget( 'ghumti_Block_Posts' );

	// Featured Slider
	register_widget( 'ghumti_Featured_Slider' );

	// Social Media
	register_widget( 'ghumti_Social_Media' );
	
	//cta with form
	register_widget('ghumti_cta_form');

	if ( class_exists( 'WooCommerce' ) ) {
		register_widget( 'ghumti_product_Carousel' );
		register_widget('ghumti_cat_product');
		register_widget('ghumti_product');
		register_widget('ghumti_special_product');
	}
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load widget required files
 *
 * @since 1.0.0
 */

get_template_part('inc/widgets/ghumti','widget-fields');    // Widget fields
get_template_part('inc/widgets/ghumti','featured-slider');  // Featured Slider widget
get_template_part('inc/widgets/ghumti','block-posts');      // Block posts widget
get_template_part('inc/widgets/ghumti','social-media');     // Social Media widget
get_template_part('inc/widgets/ghumti','cta-form');     // CTA with shortcode widget

if ( class_exists( 'WooCommerce' ) ) {
	get_template_part('inc/widgets/ghumti','product-carousel');  // Product Carousel widget
	get_template_part('inc/widgets/ghumti','product' );  // product slider widget
	get_template_part('inc/widgets/ghumti','cat-product');     // category & product widget
	get_template_part('inc/widgets/ghumti','sale-withdate');     // onsale product widget
}