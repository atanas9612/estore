<?php
/**
 * WP Commerce Header Settings panel at Theme Customizer
 *
 * @package WP Commerce
 * @since 1.0.0
 */

add_action( 'customize_register', 'wp_commerce_header_settings_register' );

function wp_commerce_header_settings_register( $wp_customize ) {

    $wp_customize->get_section( 'header_image' )->priority = '20';
    $wp_customize->get_section( 'header_image' )->title    = __( 'Header Image', 'wp-commerce' );
    $wp_customize->get_section( 'header_image' )->panel    = 'wp_commerce_header_settings_panel';

	/**
     * Add Header Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
       'wp_commerce_header_settings_panel',
       array(
           'priority'       => 10,
           'capability'     => 'edit_theme_options',
           'theme_supports' => '',
           'title'          => __( 'Header Settings', 'wp-commerce' ),
       )
   );

    /*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Top Header section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'wp_commerce_top_header_section',
        array(
        	'priority'       => 5,
        	'panel'          => 'wp_commerce_header_settings_panel',
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
            'title'          => __( 'Top Header Section', 'wp-commerce' ),
            'description'    => __( 'Managed the content display at top header section.', 'wp-commerce' ),
        )
    );

    /**
     * Switch option for Top Header
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wp_commerce_top_header_option',
        array(
        	'capability'     	=> 'edit_theme_options',
            'default' 			=> 'show',
            'sanitize_callback' => 'wp_commerce_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new WP_Commerce_Customize_Switch_Control(
        $wp_customize,
        'wp_commerce_top_header_option',
        array(
            'label'     	=> __( 'Top Header Option', 'wp-commerce' ),
            'description'   => __( 'Show/Hide option for top header section.', 'wp-commerce' ),
            'section'   	=> 'wp_commerce_top_header_section',
            'settings'		=> 'wp_commerce_top_header_option',
            'type'      	=> 'switch',
            'priority'  	=> 5,
            'choices'   	=> array(
                'show'  		=> __( 'Show', 'wp-commerce' ),
                'hide'  		=> __( 'Hide', 'wp-commerce' )
            )
        )
    )
);

    /**
     * Repeater field for top header items
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'wp_commerce_top_header_items', 
        array(
            'capability'        => 'edit_theme_options',            
            'default'           => json_encode(array(
                array(
                    'mt_item_icon' => 'fa fa-phone',
                    'mt_item_text' => '',
                )
            )
        ),
            'sanitize_callback' => 'wp_commerce_sanitize_repeater'
        )
    );
    $wp_customize->add_control( new WP_Commerce_Repeater_Controler(
        $wp_customize, 
        'wp_commerce_top_header_items', 
        array(
            'label'           => __( 'Top Header Items', 'wp-commerce' ),
            'section'         => 'wp_commerce_top_header_section',
            'settings'        => 'wp_commerce_top_header_items',
            'priority'        => 10,
            'wp_commerce_box_label'       => __( 'Single Item','wp-commerce' ),
            'wp_commerce_box_add_control' => __( 'Add Item','wp-commerce' )
        ),
        array(
            'mt_item_icon' => array(
                'type'        => 'icon',
                'label'       => __( 'Item Icon', 'wp-commerce' ),
                'description' => __( 'Choose icon for single item from available lists.', 'wp-commerce' )
            ),
            'mt_item_text' => array(
                'type'        => 'text',
                'label'       => __( 'Item Info', 'wp-commerce' ),
                'description' => __( 'Enter short info for single item.', 'wp-commerce' )
            )
        )
    ) 
);


    /*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Extra Option
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'wp_commerce_header_extra_option_section',
        array(
            'priority'       => 15,
            'panel'          => 'wp_commerce_header_settings_panel',
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Extra Options', 'wp-commerce' ),
            'description'    => __( 'Managed the several extra option in header section.', 'wp-commerce' ),
        )
    );

     /**
     * Switch option for search options
     *
     * @since 1.0.0
     */
     $wp_customize->add_setting(
        'wp_commerce_header_search_option',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'show',
            'sanitize_callback' => 'wp_commerce_sanitize_switch_option',
        )
    );
     $wp_customize->add_control( new WP_Commerce_Customize_Switch_Control(
        $wp_customize,
        'wp_commerce_header_search_option',
        array(
            'label'         => __( 'Header Search Option', 'wp-commerce' ),
            'description'   => __( 'Show/Hide option for search form at header section.', 'wp-commerce' ),
            'section'       => 'wp_commerce_header_extra_option_section',
            'settings'      => 'wp_commerce_header_search_option',
            'type'          => 'switch',
            'priority'      => 5,
            'choices'       => array(
                'show'          => __( 'Show', 'wp-commerce' ),
                'hide'          => __( 'Hide', 'wp-commerce' )
            )
        )
    )
 );

     /**
     * Switch option for shopping cart icon
     *
     * @since 1.0.0
     */
     $wp_customize->add_setting(
        'wp_commerce_header_cart_option',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'show',
            'sanitize_callback' => 'wp_commerce_sanitize_switch_option',
        )
    );
     $wp_customize->add_control( new WP_Commerce_Customize_Switch_Control(
        $wp_customize,
        'wp_commerce_header_cart_option',
        array(
            'label'         => __( 'Header Cart Option', 'wp-commerce' ),
            'description'   => __( 'Show/Hide option for shopping cart at header section.', 'wp-commerce' ),
            'section'       => 'wp_commerce_header_extra_option_section',
            'settings'      => 'wp_commerce_header_cart_option',
            'type'          => 'switch',
            'priority'      => 6,
            'choices'       => array(
                'show'          => __( 'Show', 'wp-commerce' ),
                'hide'          => __( 'Hide', 'wp-commerce' )
            )
        )
    )
 );

     $wp_customize->add_setting(
        'wp_commerce_currency_exchange_code',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'wp_commerce_currency_exchange_code',
        array(
            'label'         => __( 'Header Currency Exchanger', 'wp-commerce' ),
            'description'   => __( 'Type shortcode Eg:-[wcj_currency_select_drop_down_list]', 'wp-commerce' ),
            'section'       => 'wp_commerce_header_extra_option_section',
            'settings'      => 'wp_commerce_currency_exchange_code',
            'type'          => 'text'
        )
 );

 }