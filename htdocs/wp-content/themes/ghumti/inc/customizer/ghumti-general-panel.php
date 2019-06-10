<?php
/**
 * Ghumti General Settings panel at Theme Customizer
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

add_action( 'customize_register', 'ghumti_general_settings_register' );

function ghumti_general_settings_register( $wp_customize ) {

	$wp_customize->get_section( 'title_tagline' )->panel = 'ghumti_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = '5';
    $wp_customize->get_section( 'colors' )->panel    = 'ghumti_general_settings_panel';
    $wp_customize->get_section( 'colors' )->priority = '10';
    $wp_customize->get_section( 'background_image' )->panel = 'ghumti_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority = '15';
    $wp_customize->get_section( 'static_front_page' )->panel = 'ghumti_general_settings_panel';
    $wp_customize->get_section( 'static_front_page' )->priority = '20';

    /**
     * Add General Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'ghumti_general_settings_panel',
	    array(
	        'priority'       => 5,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'General Settings', 'ghumti' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/

    /**
     * Title Color
     *
     * @since 1.0.0
     */

    $wp_customize->add_setting(
        'ghumti_site_title_color',
        array(
            'default'     => '#000000',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
 
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'ghumti_site_title_color',
            array(
                'label'      => __( 'Header Text Color', 'ghumti' ),
                'section'    => 'colors',
                'priority'   => 5
            )
        )
    );
    
/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Website layout section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'ghumti_website_layout_section',
        array(
            'title'         => __( 'Website Layout', 'ghumti' ),
            'description'   => __( 'Choose a site to display your website more effectively.', 'ghumti' ),
            'priority'      => 55,
            'panel'         => 'ghumti_general_settings_panel',
        )
    );
    
    $wp_customize->add_setting(
        'ghumti_site_layout',
        array(
            'default'           => 'fullwidth_layout',
            'sanitize_callback' => 'ghumti_sanitize_site_layout',
        )       
    );
    $wp_customize->add_control(
        'ghumti_site_layout',
        array(
            'type' => 'radio',
            'priority'    => 5,
            'label' => __( 'Site Layout', 'ghumti' ),
            'section' => 'ghumti_website_layout_section',
            'choices' => array(
                'fullwidth_layout' => __( 'FullWidth Layout', 'ghumti' ),
                'boxed_layout' => __( 'Boxed Layout', 'ghumti' )
            ),
        )
    );
// /*------------------------------------------------------------------------------------------*/
//     /**
//      * Title and tagline checkbox
//      *
//      * @since 1.0.1
//      */
//     $wp_customize->add_setting( 
//         'ghumti_site_title_option', 
//         array(
//             'default' => true,
//             'sanitize_callback' => 'ghumti_sanitize_checkbox'
//         )
//     );
//     $wp_customize->add_control( 
//         'ghumti_site_title_option', 
//         array(
//             'label' => esc_html__( 'Display Site Title and Tagline', 'ghumti' ),
//             'section' => 'title_tagline',
//             'type' => 'checkbox'
//         )
//     );

}