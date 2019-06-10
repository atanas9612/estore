<?php
/**
 * WP Commerce Frontpage Settings panel at Theme Customizer
 *
 * @package WP Commerce
 * @since 1.0.0
 */
add_action( 'customize_register', 'wp_commerce_frontpage_settings_register' );

function wp_commerce_frontpage_settings_register( $wp_customize ) {

/**
 * Add Frontpage Settings Panel
 *
 * @since 1.0.0
 */
$wp_customize->add_panel(
    'wp_commerce_frontpage_settings_panel',
    array(
        'priority'       => 15,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Frontpage Settings', 'wp-commerce' ),
    )
);

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Front Product Slider section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'wp_commerce_frontpage_slider_section',
    array(
    	'priority'       => 1,
    	'panel'          => 'wp_commerce_frontpage_settings_panel',
    	'capability'     => 'edit_theme_options',
    	'theme_supports' => '',
        'title'          => __( 'Product Slider Section', 'wp-commerce' ),
        'description'    => __( 'Managed the slider display at Frontpage section.', 'wp-commerce' ),
    )
);

/**
 * Switch option for  Product Slider
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'wp_commerce_frontpage_slider_option',
    array(
    	'capability'     	=> 'edit_theme_options',
        'default' 			=> 'show',
        'sanitize_callback' => 'wp_commerce_sanitize_switch_option',
    )
);
$wp_customize->add_control( new WP_Commerce_Customize_Switch_Control(
    $wp_customize,
        'wp_commerce_frontpage_slider_option',
        array(
            'label'     	=> __( 'Frontpage Product Slider Option', 'wp-commerce' ),
            'description'   => __( 'Show/Hide option for Frontpage Product Slider section.', 'wp-commerce' ),
            'section'   	=> 'wp_commerce_frontpage_slider_section',
            'settings'		=> 'wp_commerce_frontpage_slider_option',
            'type'      	=> 'switch',
            'choices'   	=> array(
                'show'  		=> __( 'Show', 'wp-commerce' ),
                'hide'  		=> __( 'Hide', 'wp-commerce' )
            )
        )
    )
);


 /**
 *  Category Selection for Frontpage Product Slider
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'wp_commerce_frontpage_slider_items',
    array(
        'capability'        => 'edit_theme_options',
        'default'           => 'show',
        'sanitize_callback' => 'wp_commerce_sanitize_category',
    )
);

$wp_customize->add_control( new WP_Commerce_Customize_Product_Category_Control(
$wp_customize,
    'wp_commerce_frontpage_slider_items',
    array(
            'label' => __('Select Category for slider','wp-commerce'),
            'section' => 'wp_commerce_frontpage_slider_section',
            'settings' => 'wp_commerce_frontpage_slider_items',
            'type'=> 'dropdown-taxonomies',
        )
    )
);

$wp_customize->add_setting( 'wp_commerce_frontpage_slider_items_number', array(
    'capability'            => 'edit_theme_options',
    'default'               => 3,
    'sanitize_callback'     => 'absint'
));


$wp_customize->add_control( 'wp_commerce_frontpage_slider_items_number', array(
    'label'                 =>  __( 'Number of Slider to slide', 'wp-commerce' ),
    'description'           =>  __( 'input 3,4,5,6,7,8,9,10', 'wp-commerce' ),
    'section'               => 'wp_commerce_frontpage_slider_section',
    'type'                  => 'number',
    'settings' => 'wp_commerce_frontpage_slider_items_number',
) );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Front Promo section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'wp_commerce_frontpage_promo_section',
    array(
    	'priority'       => 2,
    	'panel'          => 'wp_commerce_frontpage_settings_panel',
    	'capability'     => 'edit_theme_options',
    	'theme_supports' => '',
        'title'          => __( 'Promo Section', 'wp-commerce' ),
        'description'    => __( 'Managed the promo display at Frontpage section.', 'wp-commerce' ),
    )
);

/**
 * Switch option for Promo Options
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'wp_commerce_frontpage_promo_option',
    array(
    	'capability'     	=> 'edit_theme_options',
        'default' 			=> 'show',
        'sanitize_callback' => 'wp_commerce_sanitize_switch_option',
    )
);
$wp_customize->add_control( new WP_Commerce_Customize_Switch_Control(
    $wp_customize,
        'wp_commerce_frontpage_promo_option',
        array(
            'label'     	=> __( 'Frontpage Promo Option', 'wp-commerce' ),
            'description'   => __( 'Show/Hide option for Frontpage Promo section.', 'wp-commerce' ),
            'section'   	=> 'wp_commerce_frontpage_promo_section',
            'settings'		=> 'wp_commerce_frontpage_promo_option',
            'type'      	=> 'switch',
            'choices'   	=> array(
                'show'  		=> __( 'Show', 'wp-commerce' ),
                'hide'  		=> __( 'Hide', 'wp-commerce' )
            )
        )
    )
);   


 /**
 * Repeater field for Frontpage Promo options
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'wp_commerce_frontpage_promo_items',
    array(
    	'capability'     	=> 'edit_theme_options',
        'default' 			=> json_encode(array(
                array(
                    'mt_item_text' => __('Collection 2018','wp-commerce'),
                    'mt_item_text1' => __('Sale up to 20% off','wp-commerce'),
                    'mt_item_upload' => ''
                )
            )
        ),
        'sanitize_callback' => 'wp_commerce_sanitize_repeater',
    )
);
$wp_customize->add_control( new WP_Commerce_Repeater_Controler(
    $wp_customize,
        'wp_commerce_frontpage_promo_items',
        array(
            'label'     	=> __( 'Frontpage Promo Items', 'wp-commerce' ),
            'section'   	=> 'wp_commerce_frontpage_promo_section',
            'settings'		=> 'wp_commerce_frontpage_promo_items',
            'wp_commerce_box_label'       => __( 'Promo Item','wp-commerce' ),
            'wp_commerce_box_add_control' => __( 'Add Item','wp-commerce' )
        ),
         array(
            'mt_item_text' => array(
                'type'        => 'text',
                'label'       => __( 'Item title', 'wp-commerce' ),
                'description' => __( 'Enter item title', 'wp-commerce' )
            ),
            'mt_item_text1' => array(
                'type'        => 'text',
                'label'       => __( 'Item Info', 'wp-commerce' ),
                'description' => __( 'Enter short info for item.', 'wp-commerce' )
            ),
            'mt_item_upload' => array(
                'type'        => 'upload',
                'label'       => __( 'Item Feature Image', 'wp-commerce' ),
                'description' => __( 'Upload Feature Image.', 'wp-commerce' )
            )
        )
    )
);   


/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Front Featured Products section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'wp_commerce_frontpage_feature_product_section',
    array(
    	'priority'       => 3,
    	'panel'          => 'wp_commerce_frontpage_settings_panel',
    	'capability'     => 'edit_theme_options',
    	'theme_supports' => '',
        'title'          => __( 'Feature Products Section', 'wp-commerce' ),
        'description'    => __( 'Managed the Feature Products Section display at Frontpage section.', 'wp-commerce' ),
    )
);

/**
 * Switch option for Featured Products
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'wp_commerce_frontpage_feature_product_option',
    array(
    	'capability'     	=> 'edit_theme_options',
        'default' 			=> 'show',
        'sanitize_callback' => 'wp_commerce_sanitize_switch_option',
    )
);
$wp_customize->add_control( new WP_Commerce_Customize_Switch_Control(
    $wp_customize,
        'wp_commerce_frontpage_feature_product_option',
        array(
            'label'     	=> __( 'Frontpage Feature Products Option', 'wp-commerce' ),
            'description'   => __( 'Show/Hide option for Frontpage Feature Products section.', 'wp-commerce' ),
            'section'   	=> 'wp_commerce_frontpage_feature_product_section',
            'settings'		=> 'wp_commerce_frontpage_feature_product_option',
            'type'      	=> 'switch',
            'choices'   	=> array(
                'show'  		=> __( 'Show', 'wp-commerce' ),
                'hide'  		=> __( 'Hide', 'wp-commerce' )
            )
        )
    )
);      

$wp_customize->add_setting( 'wp_commerce_frontpage_feature_product_text', array(
    'capability'            => 'edit_theme_options',
    'default'               => __('Feature Products','wp-commerce'),
    'sanitize_callback'     => 'sanitize_text_field'
) );

$wp_customize->add_control( 'wp_commerce_frontpage_feature_product_text', array(
    'label'                 =>   __( 'Feature Products Text', 'wp-commerce' ),
    'section'               => 'wp_commerce_frontpage_feature_product_section',
    'type'                  => 'text',
    'settings' => 'wp_commerce_frontpage_feature_product_text',
) );


$wp_customize->add_setting('wp_commerce_feature_products', array(
  'default' => '',
  'type' => 'customtext',
  'capability' => 'edit_theme_options',
  'transport' => 'refresh',
  'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new WP_Commerce_Feature_Products_Widget( $wp_customize, 'wp_commerce_feature_products', array(
    'label' => esc_attr__( 'Go to Widget', 'wp-commerce' ),
    'section' => 'wp_commerce_frontpage_feature_product_section',
    'settings' => 'wp_commerce_feature_products',
    'extra' => esc_attr__( ' for adding products in this section', 'wp-commerce' )
    ) ) 
);
/*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Front New Arrivals section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'wp_commerce_frontpage_new_arrivals_section',
        array(
        	'priority'       => 4,
        	'panel'          => 'wp_commerce_frontpage_settings_panel',
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
            'title'          => __( 'New Arrivals Section', 'wp-commerce' ),
            'description'    => __( 'Managed the New Arrivals section display at Frontpage section.', 'wp-commerce' ),
        )
    );

    /**
     * Switch option for Promo Options
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wp_commerce_frontpage_new_arrivals_option',
        array(
        	'capability'     	=> 'edit_theme_options',
            'default' 			=> 'show',
            'sanitize_callback' => 'wp_commerce_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new WP_Commerce_Customize_Switch_Control(
        $wp_customize,
            'wp_commerce_frontpage_new_arrivals_option',
            array(
                'label'     	=> __( 'Frontpage New Arrivals Option', 'wp-commerce' ),
                'description'   => __( 'Show/Hide option for Frontpage New Arrivals section.', 'wp-commerce' ),
                'section'   	=> 'wp_commerce_frontpage_new_arrivals_section',
                'settings'		=> 'wp_commerce_frontpage_new_arrivals_option',
                'type'      	=> 'switch',
                'choices'   	=> array(
                    'show'  		=> __( 'Show', 'wp-commerce' ),
                    'hide'  		=> __( 'Hide', 'wp-commerce' )
                )
            )
        )
    );   

$wp_customize->add_setting( 'wp_commerce_frontpage_new_arrivals_text', array(
    'capability'            => 'edit_theme_options',
    'default'               => __('New Arrivals','wp-commerce'),
    'sanitize_callback'     => 'sanitize_text_field'
) );

$wp_customize->add_control( 'wp_commerce_frontpage_new_arrivals_text', array(
    'label'                 =>   __( 'New Arrivals Text', 'wp-commerce' ),
    'section'               => 'wp_commerce_frontpage_new_arrivals_section',
    'type'                  => 'text',
    'settings' => 'wp_commerce_frontpage_new_arrivals_text',
) );


$wp_customize->add_setting('wp_commerce_new_arrivals_products', array(
    'default' => '',
    'type' => 'customtext',
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new WP_Commerce_New_Arrivals_Products_Widget( $wp_customize, 'wp_commerce_new_arrivals_products', array(
    'label' => esc_attr__( 'Go to Widget', 'wp-commerce' ),
    'section' => 'wp_commerce_frontpage_new_arrivals_section',
    'settings' => 'wp_commerce_new_arrivals_products',
    'extra' => esc_attr__( ' for adding products in this section', 'wp-commerce' )
) ) 
);
/*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Front Hot Products section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'wp_commerce_frontpage_hot_products_section',
        array(
        	'priority'       => 4,
        	'panel'          => 'wp_commerce_frontpage_settings_panel',
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
            'title'          => __( 'Hot Products Section', 'wp-commerce' ),
            'description'    => __( 'Managed the Hot Products section display at Frontpage section.', 'wp-commerce' ),
        )
    );

    /**
     * Switch option for Hot Products Options
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wp_commerce_frontpage_hot_products_option',
        array(
        	'capability'     	=> 'edit_theme_options',
            'default' 			=> 'show',
            'sanitize_callback' => 'wp_commerce_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new WP_Commerce_Customize_Switch_Control(
        $wp_customize,
            'wp_commerce_frontpage_hot_products_option',
            array(
                'label'     	=> __( 'Frontpage Hot Products Option', 'wp-commerce' ),
                'description'   => __( 'Show/Hide option for Frontpage Hot Products section.', 'wp-commerce' ),
                'section'   	=> 'wp_commerce_frontpage_hot_products_section',
                'settings'		=> 'wp_commerce_frontpage_hot_products_option',
                'type'      	=> 'switch',
                'choices'   	=> array(
                    'show'  		=> __( 'Show', 'wp-commerce' ),
                    'hide'  		=> __( 'Hide', 'wp-commerce' )
                )
            )
        )
    );   


$wp_customize->add_setting( 'wp_commerce_frontpage_hot_products_text', array(
    'capability'            => 'edit_theme_options',
    'default'               => __('Hot Products','wp-commerce'),
    'sanitize_callback'     => 'sanitize_text_field'
) );

$wp_customize->add_control( 'wp_commerce_frontpage_hot_products_text', array(
    'label'                 =>   __( 'Hot Products Text', 'wp-commerce' ),
    'section'               => 'wp_commerce_frontpage_hot_products_section',
    'type'                  => 'text',
    'settings' => 'wp_commerce_frontpage_hot_products_text',
) );


$wp_customize->add_setting('wp_commerce_frontpage_hot_products', array(
    'default' => '',
    'type' => 'customtext',
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new WP_Commerce_Hot_Products_Widget( $wp_customize, 'wp_commerce_frontpage_hot_products', array(
    'label' => esc_attr__( 'Go to Widget', 'wp-commerce' ),
    'section' => 'wp_commerce_frontpage_hot_products_section',
    'settings' => 'wp_commerce_frontpage_hot_products',
    'extra' => esc_attr__( ' for adding products in this section', 'wp-commerce' )
) ) 
);      


/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Front Service section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'wp_commerce_frontpage_service_section',
    array(
        'priority'       => 5,
        'panel'          => 'wp_commerce_frontpage_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Service Section', 'wp-commerce' ),
        'description'    => __( 'Managed the Service display at Frontpage section.', 'wp-commerce' ),
    )
);

/**
 * Switch option for Service Options
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'wp_commerce_frontpage_service_option',
    array(
        'capability'        => 'edit_theme_options',
        'default'           => 'show',
        'sanitize_callback' => 'wp_commerce_sanitize_switch_option',
    )
);
$wp_customize->add_control( new WP_Commerce_Customize_Switch_Control(
    $wp_customize,
        'wp_commerce_frontpage_service_option',
        array(
            'label'         => __( 'Frontpage Service Option', 'wp-commerce' ),
            'description'   => __( 'Show/Hide option for Frontpage Service section.', 'wp-commerce' ),
            'section'       => 'wp_commerce_frontpage_service_section',
            'settings'      => 'wp_commerce_frontpage_service_option',
            'type'          => 'switch',
            'choices'       => array(
                'show'          => __( 'Show', 'wp-commerce' ),
                'hide'          => __( 'Hide', 'wp-commerce' )
            )
        )
    )
);   


 /**
 *  Category Selection for Frontpage Service Section
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'wp_commerce_frontpage_service_category',
    array(
        'capability'        => 'edit_theme_options',
        'default'           => 'show',
        'sanitize_callback' => 'wp_commerce_sanitize_category',
    )
);

$wp_customize->add_control( new WP_Commerce_Customize_Dropdown_Taxonomies_Control($wp_customize,
    'wp_commerce_frontpage_service_category',
    array(
            'label' => __('Select Category for Service','wp-commerce'),
            'section' => 'wp_commerce_frontpage_service_section',
            'settings' => 'wp_commerce_frontpage_service_category',
            'type'=> 'dropdown-post-taxonomies',
        )
    )
);

$wp_customize->add_setting( 'wp_commerce_frontpage_service_items_number', array(
    'capability'            => 'edit_theme_options',
    'default'               => 3,
    'sanitize_callback'     => 'absint'
));


$wp_customize->add_control( 'wp_commerce_frontpage_service_items_number', array(
    'label'                 =>  __( 'Number of service to display', 'wp-commerce' ),
    'description'           =>  __( 'input 3,4,5,6,7,8,9,10', 'wp-commerce' ),
    'section'               => 'wp_commerce_frontpage_service_section',
    'type'                  => 'number',
    'settings' => 'wp_commerce_frontpage_service_items_number',
) ); 


/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Front Latest News section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'wp_commerce_frontpage_latest_news_section',
    array(
        'priority'       => 6,
        'panel'          => 'wp_commerce_frontpage_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Latest News Section', 'wp-commerce' ),
        'description'    => __( 'Managed the Latest News display at Frontpage section.', 'wp-commerce' ),
    )
);

/**
 * Switch option for Latest News Options
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'wp_commerce_frontpage_latest_news_option',
    array(
        'capability'        => 'edit_theme_options',
        'default'           => 'show',
        'sanitize_callback' => 'wp_commerce_sanitize_switch_option',
    )
);
$wp_customize->add_control( new WP_Commerce_Customize_Switch_Control(
    $wp_customize,
        'wp_commerce_frontpage_latest_news_option',
        array(
            'label'         => __( 'Frontpage Latest News Option', 'wp-commerce' ),
            'description'   => __( 'Show/Hide option for Frontpage Latest News section.', 'wp-commerce' ),
            'section'       => 'wp_commerce_frontpage_latest_news_section',
            'settings'      => 'wp_commerce_frontpage_latest_news_option',
            'type'          => 'switch',
            'choices'       => array(
                'show'          => __( 'Show', 'wp-commerce' ),
                'hide'          => __( 'Hide', 'wp-commerce' )
            )
        )
    )
);   

$wp_customize->add_setting( 'wp_commerce_frontpage_latest_news_text', array(
    'capability'            => 'edit_theme_options',
    'default'               => __('Latest News','wp-commerce'),
    'sanitize_callback'     => 'sanitize_text_field'
) );

$wp_customize->add_control( 'wp_commerce_frontpage_latest_news_text', array(
    'label'                 =>   __( 'Latest News Title', 'wp-commerce' ),
    'section'               => 'wp_commerce_frontpage_latest_news_section',
    'type'                  => 'text',
    'settings' => 'wp_commerce_frontpage_latest_news_text',
) );

 /**
 *  Category Selection for Frontpage Latest News Section
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'wp_commerce_frontpage_latest_news_category',
    array(
        'capability'        => 'edit_theme_options',
        'default'           => 'show',
        'sanitize_callback' => 'wp_commerce_sanitize_category',
    )
);

$wp_customize->add_control( new WP_Commerce_Customize_Dropdown_Taxonomies_Control(
$wp_customize,
    'wp_commerce_frontpage_latest_news_category',
    array(
            'label' => __('Select Category for Service','wp-commerce'),
            'section' => 'wp_commerce_frontpage_latest_news_section',
            'settings' => 'wp_commerce_frontpage_latest_news_category',
            'type'=> 'dropdown-post-taxonomies',
        )
    )
);

$wp_customize->add_setting( 'wp_commerce_frontpage_latest_news_items_number', array(
    'capability'            => 'edit_theme_options',
    'default'               => 3,
    'sanitize_callback'     => 'absint'
));


$wp_customize->add_control( 'wp_commerce_frontpage_latest_news_items_number', array(
    'label'                 =>  __( 'Number of Latest News to display', 'wp-commerce' ),
    'description'           =>  __( 'input 3,4,5,6,7,8,9,10', 'wp-commerce' ),
    'section'               => 'wp_commerce_frontpage_latest_news_section',
    'type'                  => 'number',
    'settings' => 'wp_commerce_frontpage_latest_news_items_number',
) ); 

}