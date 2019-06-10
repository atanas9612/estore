<?php
/**
 * Ghumti Innerpage Design Settings panel at Theme Customizer
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

add_action( 'customize_register', 'ghumti_design_settings_register' );

function ghumti_design_settings_register( $wp_customize ) {

	// Register the radio image control class as a JS control type.
    $wp_customize->register_control_type( 'ghumti_Customize_Control_Radio_Image' );

	/**
     * Add Innerpage Design Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'ghumti_design_settings_panel',
	    array(
	        'priority'       => 25,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'InnerPage Designs', 'ghumti' ),
	    )
    );

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Archive Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'ghumti_archive_settings_section',
        array(
            'title'     => esc_html__( 'Archive Settings', 'ghumti' ),
            'panel'     => 'ghumti_design_settings_panel',
            'priority'  => 5,
        )
    );      

    /**
     * Image Radio field for archive sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_archive_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new ghumti_Customize_Control_Radio_Image(
        $wp_customize,
        'ghumti_archive_sidebar',
            array(
                'label'    => esc_html__( 'Archive Sidebars', 'ghumti' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'ghumti' ),
                'section'  => 'ghumti_archive_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'ghumti' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'ghumti' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'ghumti' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Image Radio field for archive layout
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_archive_layout',
        array(
            'default'           => 'classic',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new ghumti_Customize_Control_Radio_Image(
        $wp_customize,
        'ghumti_archive_layout',
            array(
                'label'    => esc_html__( 'Archive Layouts', 'ghumti' ),
                'description' => esc_html__( 'Choose layout from available layouts', 'ghumti' ),
                'section'  => 'ghumti_archive_settings_section',
                'choices'  => array(
                        'classic' => array(
                            'label' => esc_html__( 'Classic', 'ghumti' ),
                            'url'   => '%s/assets/images/archive-layout1.png'
                        ),
                        'grid' => array(
                            'label' => esc_html__( 'Grid', 'ghumti' ),
                            'url'   => '%s/assets/images/archive-layout2.png'
                        )
                ),
                'priority' => 10
            )
        )
    );

    /**
     * Text field for archive read more
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_archive_read_more_text',
        array(
            'default'      => __( 'Continue Reading', 'ghumti' ),
            'transport'    => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'ghumti_archive_read_more_text',
        array(
            'type'      	=> 'text',
            'label'        	=> esc_html__( 'Read More Text', 'ghumti' ),
            'description'  	=> __( 'Enter read more button text for archive page.', 'ghumti' ),
            'section'   	=> 'ghumti_archive_settings_section',
            'priority'  	=> 15
        )
    );
    $wp_customize->selective_refresh->add_partial( 
        'ghumti_archive_read_more_text', 
            array(
                'selector' => '.ghumti-archive-more > a',
                'render_callback' => 'ghumti_customize_partial_archive_more',
            )
    );

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Page Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'ghumti_page_settings_section',
        array(
            'title'     => esc_html__( 'Page Settings', 'ghumti' ),
            'panel'     => 'ghumti_design_settings_panel',
            'priority'  => 10,
        )
    );      

    /**
     * Image Radio for page sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_default_page_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new ghumti_Customize_Control_Radio_Image(
        $wp_customize,
        'ghumti_default_page_sidebar',
            array(
                'label'    => esc_html__( 'Page Sidebars', 'ghumti' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'ghumti' ),
                'section'  => 'ghumti_page_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'ghumti' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'ghumti' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'ghumti' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Post Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'ghumti_post_settings_section',
        array(
            'title'     => esc_html__( 'Post Settings', 'ghumti' ),
            'panel'     => 'ghumti_design_settings_panel',
            'priority'  => 15,
        )
    );      

    /**
     * Image Radio for post sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_default_post_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new ghumti_Customize_Control_Radio_Image(
        $wp_customize,
        'ghumti_default_post_sidebar',
            array(
                'label'    => esc_html__( 'Post Sidebars', 'ghumti' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'ghumti' ),
                'section'  => 'ghumti_post_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'ghumti' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'ghumti' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'ghumti' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Switch option for Related posts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_related_posts_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'ghumti_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new ghumti_Customize_Switch_Control(
        $wp_customize,
            'ghumti_related_posts_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Related Post Option', 'ghumti' ),
                'description'   => esc_html__( 'Show/Hide option for related posts section at single post page.', 'ghumti' ),
                'section'   => 'ghumti_post_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'ghumti' ),
                    'hide'  => esc_html__( 'Hide', 'ghumti' )
                    ),
                'priority'  => 10,
            )
        )
    );

    /**
     * Text field for related post section title
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_related_posts_title',
        array(
            'default'    => __( 'Related Posts', 'ghumti' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'ghumti_related_posts_title',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Related Post Section Title', 'ghumti' ),
            'section'   => 'ghumti_post_settings_section',
            'priority'  => 15
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'ghumti_related_posts_title', 
            array(
                'selector' => 'h2.ghumti-related-title',
                'render_callback' => 'ghumti_customize_partial_related_title',
            )
    );
}