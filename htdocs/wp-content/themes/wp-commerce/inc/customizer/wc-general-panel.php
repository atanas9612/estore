<?php

/**
 * WP Commerce General Settings panel at Theme Customizer
 *
 * @package WP Commerce
 * @since 1.0.0
 */
add_action( 'customize_register', 'wp_commerce_general_settings_register' );

function wp_commerce_general_settings_register( $wp_customize ) {
    
    $wp_customize->get_section( 'title_tagline' )->panel = 'wp_commerce_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = '5';
    $wp_customize->get_section( 'colors' )->panel    = 'wp_commerce_general_settings_panel';
    $wp_customize->get_section( 'colors' )->priority = '10';
    $wp_customize->get_section( 'background_image' )->panel = 'wp_commerce_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority = '15';

    /**
     * Add General Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
        'wp_commerce_general_settings_panel',
        array(
            'priority'       => 5,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'General Settings', 'wp-commerce' ),
        )
    );


/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Color option for primary theme color
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wp_commerce_primary_theme_color',
        array(
            'default'     => '#3e50b4',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    ); 
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
            'wp_commerce_primary_theme_color',
            array(
                'label'      => __( 'Primary Theme Color', 'wp-commerce' ),
                'section'    => 'colors',
                'settings'   => 'wp_commerce_primary_theme_color',
                'priority'   => 5
            )
        )
    );

    /**
     * Color option for secondary theme color
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wp_commerce_secondary_theme_color',
        array(
            'default'     => '#1f96f0',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    ); 
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
            'wp_commerce_secondary_theme_color',
            array(
                'label'      => __( 'Secondary Theme Color', 'wp-commerce' ),
                'section'    => 'colors',
                'settings'   => 'wp_commerce_secondary_theme_color',
                'priority'   => 5
            )
        )
    );

}