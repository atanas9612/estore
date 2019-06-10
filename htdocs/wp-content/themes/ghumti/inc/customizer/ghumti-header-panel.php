<?php
/**
 * Ghumti Header Settings panel at Theme Customizer
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

add_action( 'customize_register', 'ghumti_header_settings_register' );

function ghumti_header_settings_register( $wp_customize ) {


	/**
     * Add General Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel('ghumti_header_settings_panel',array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Header Settings', 'ghumti' ),
    ));


$wp_customize->get_section('header_image')->panel = 'ghumti_header_settings_panel';
$wp_customize->get_section('header_image')->title = 'Header Background Image';
$wp_customize->get_section('header_image')->priority = 3;

    /*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Header Section
     */
    $wp_customize->add_section(
        'ghumti_header_option_section',
        array(
            'title'     => __( 'General Header Options', 'ghumti' ),
            'priority'  => 5,
            'panel'     => 'ghumti_header_settings_panel'
        )
    );

    /**
     * Switch option for Top Header
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_top_header_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'ghumti_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new ghumti_Customize_Switch_Control(
        $wp_customize, 'ghumti_top_header_option', array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Top Header Section', 'ghumti' ),
            'description'   => esc_html__( 'Show/Hide option for top header section.', 'ghumti' ),
            'section'   => 'ghumti_header_option_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'ghumti' ),
                'hide'  => esc_html__( 'Hide', 'ghumti' )
            ),
            'priority'  => 5,
        )
    ));

    /**
     * Switch option for user and cart Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_top_icons_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'ghumti_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new ghumti_Customize_Switch_Control(
        $wp_customize,
        'ghumti_top_icons_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'User & Cart Icons', 'ghumti' ),
            'description'   => esc_html__( 'Show/Hide option for user,cart and wishlist icon beside logo.', 'ghumti' ),
            'section'   => 'ghumti_header_option_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'ghumti' ),
                'hide'  => esc_html__( 'Hide', 'ghumti' )
            ),
            'priority'  => 10,
        )
    ));
    
    /**
     * Switch option for Search Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_search_icon_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'ghumti_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new ghumti_Customize_Switch_Control(
        $wp_customize,
        'ghumti_search_icon_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Search Icon', 'ghumti' ),
            'description'   => esc_html__( 'Show/Hide option for search icon at primary menu.', 'ghumti' ),
            'section'   => 'ghumti_header_option_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'ghumti' ),
                'hide'  => esc_html__( 'Hide', 'ghumti' )
            ),
            'priority'  => 15,
        )
    ));

    /*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Ticker Section
     */
    $wp_customize->add_section(
        'ghumti_ticker_section',
        array(
            'title'     => __( 'Ticker Section', 'ghumti' ),
            'priority'  => 15,
            'panel'     => 'ghumti_header_settings_panel'
        )
    );

    /**
     * Switch option for Home Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_ticker_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'ghumti_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new ghumti_Customize_Switch_Control(
        $wp_customize,
        'ghumti_ticker_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Ticker Option', 'ghumti' ),
            'description'   => esc_html__( 'Show/Hide option for news ticker section.', 'ghumti' ),
            'section'   => 'ghumti_ticker_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'ghumti' ),
                'hide'  => esc_html__( 'Hide', 'ghumti' )
            ),
            'priority'  => 5,
        )
    ));

    /**
     * Text field for ticker caption
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_ticker_caption',
        array(
            'default'    => __( 'Breaking News', 'ghumti' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'ghumti_ticker_caption',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Ticker Caption', 'ghumti' ),
            'section'   => 'ghumti_ticker_section',
            'priority'  => 10
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'ghumti_ticker_caption', 
        array(
            'selector' => '.ticker-caption',
            'render_callback' => 'ghumti_customize_partial_ticker_caption',
        )
    );

    /*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Social Icons Section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'ghumti_social_icons_section',
        array(
            'title'     => esc_html__( 'Social Icons', 'ghumti' ),
            'panel'     => 'ghumti_header_settings_panel',
            'priority'  => 5,
        )
    );

    /**
     * Switch option for Social Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_top_social_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'ghumti_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new ghumti_Customize_Switch_Control(
        $wp_customize,
        'ghumti_top_social_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Social Icons', 'ghumti' ),
            'description'   => esc_html__( 'Show/Hide option for social media icons at top header section.', 'ghumti' ),
            'section'   => 'ghumti_social_icons_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'ghumti' ),
                'hide'  => esc_html__( 'Hide', 'ghumti' )
            ),
            'priority'  => 5,
        )
    ));

    /**
     * Repeater field for social media icons
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'social_media_icons', 
        array(
            'sanitize_callback' => 'ghumti_sanitize_repeater',
            'default' => json_encode(array(
                array(
                    'social_icon_class' => 'fa fa-facebook-f',
                    'social_icon_url' => '',
                )
            ))
        )
    );
    $wp_customize->add_control( new ghumti_Repeater_Controler(
        $wp_customize, 
        'social_media_icons', 
        array(
            'label'   => __( 'Social Media Icons', 'ghumti' ),
            'section' => 'ghumti_social_icons_section',
            'settings' => 'social_media_icons',
            'priority' => 15,
            'ghumti_box_label' => __( 'Social Media Icon','ghumti' ),
            'ghumti_box_add_control' => __( 'Add Icon','ghumti' )
        ),
        array(
            'social_icon_class' => array(
                'type'        => 'social_icon',
                'label'       => __( 'Social Media Logo', 'ghumti' ),
                'description' => __( 'Choose social media icon.', 'ghumti' )
            ),
            'social_icon_url' => array(
                'type'        => 'url',
                'label'       => __( 'Social Icon Url', 'ghumti' ),
                'description' => __( 'Enter social media url.', 'ghumti' )
            )
        )
    ));

}//header panel close