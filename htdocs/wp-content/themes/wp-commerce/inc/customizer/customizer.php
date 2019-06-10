<?php
/**
 * wp-commerce Theme Customizer
 *
 * @package WP Commerce
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp_commerce_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'wp_commerce_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'wp_commerce_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'wp_commerce_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wp_commerce_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wp_commerce_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_commerce_customize_preview_js() {
	wp_enqueue_script( 'wp-commerce-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'wp_commerce_customize_preview_js' );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */
function wp_commerce_customize_backend_scripts() {

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0' );
    
    wp_enqueue_style( 'wp_commerce_admin_customizer_style', get_template_directory_uri() . '/assets/library/wc-customizer-style.css', array(), esc_attr( wp_commerce_VERSION ) );

    wp_enqueue_script( 'wp_commerce_admin_customizer', get_template_directory_uri() . '/assets/library/wc-customizer-controls.js', array( 'jquery', 'customize-controls' ), '1.0.4', true );

    wp_enqueue_script('wp-commerce-customizer', get_template_directory_uri() . '/inc/upgrade-to-pro/pro.js', array('jquery'), '1.3.0', true);

    wp_localize_script( 'wp-commerce-customizer', 'wp_commerce_customizer_js_obj', array(
        'pro' => __('Upgrade To WP Commerce Pro','wp-commerce')
    ) );
    wp_enqueue_style( 'wp-commerce-customizer', get_template_directory_uri() . '/inc/upgrade-to-pro/pro.css');
}
add_action( 'customize_controls_enqueue_scripts', 'wp_commerce_customize_backend_scripts', 10 );


/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Load customizer required panels.
 */

require get_template_directory() . '/inc/customizer/wc-general-panel.php';
require get_template_directory() . '/inc/customizer/wc-header-panel.php';
require get_template_directory() . '/inc/customizer/wc-frontpage-panel.php';
require get_template_directory() . '/inc/customizer/wc-footer-panel.php';
require get_template_directory() . '/inc/customizer/wc-customizer-classes.php';
require get_template_directory() . '/inc/customizer/wc-customizer-sanitize.php';