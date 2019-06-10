<?php
/**
 * Ghumti Homepage Settings panel at Theme Customizer
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

add_action( 'customize_register', 'ghumti_homepage_settings_register' );

function ghumti_homepage_settings_register( $wp_customize ) {

	/**
     * Add Homepage Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
	    'ghumti_homepage_settings_section',
	    array(
	        'priority'       => 20,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Home Template Setups', 'ghumti' ),
	    )
    );

    /**
     * option for Logo Alignment
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_homepage',
        array(
            'default' => __('All contents of this section are controlled from Widgets. It is just for your information and modifying this text will have no effect.','ghumti'),
            'sanitize_callback' => 'sanitize_text',
        )
    );
    $wp_customize->add_control('ghumti_homepage', array(
        'type'      => 'textarea',
        'label'     => esc_html__( 'Homepage Sections Setups', 'ghumti' ),
        'description'     => esc_html__( 'Go To Widgets section and add widgets as per the widget areas to load in homepage sections.', 'ghumti' ),
        'section'   => 'ghumti_homepage_settings_section',
        'priority'  => 5,
    ));

}