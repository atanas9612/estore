<?php
/**
 * Ghumti Theme Customizer
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ghumti_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
    $wp_customize->selective_refresh->add_partial( 
        'blogname', 
            array(
                'selector' => '.site-title a',
                'render_callback' => 'ghumti_customize_partial_blogname',
            )
    );

    $wp_customize->selective_refresh->add_partial( 
        'blogdescription', 
            array(
                'selector' => '.site-description',
                'render_callback' => 'ghumti_customize_partial_blogdescription',
            )
    );
}
add_action( 'customize_register', 'ghumti_customize_register' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ghumti_customize_preview_js() {
	wp_enqueue_script( 'ghumti_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20180416', true );
}
add_action( 'customize_preview_init', 'ghumti_customize_preview_js' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */
function ghumti_customize_backend_scripts() {

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
    
    wp_enqueue_style( 'ghumti_admin_customizer_style', get_template_directory_uri() . '/assets/css/ghumti-customizer-style.css' );

    wp_enqueue_script( 'ghumti_admin_customizer', get_template_directory_uri() . '/assets/js/ghumti-customizer-controls.js', array( 'jquery', 'customize-controls' ), '20180416', true );
}
add_action( 'customize_controls_enqueue_scripts', 'ghumti_customize_backend_scripts', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load required files for customizer section
 *
 * @since 1.0.0
 */

get_template_part('inc/customizer/ghumti','general-panel');          // General Settings
get_template_part('inc/customizer/ghumti','header-panel');  		    // Header Settings
get_template_part('inc/customizer/ghumti','homepage-panel');       // Homepage Settings
get_template_part('inc/customizer/ghumti','innerpage-panel');           // Innerpage Design Settings
get_template_part('inc/customizer/ghumti','footer-panel');           // Footer Settings
get_template_part('inc/customizer/ghumti','custom-classes');         // Custom Classes
get_template_part('inc/customizer/ghumti','customizer-sanitize');    // Customizer Sanitize