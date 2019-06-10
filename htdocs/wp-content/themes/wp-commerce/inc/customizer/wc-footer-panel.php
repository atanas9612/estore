<?php
/**
 * WP Commerce Footer Settings panel.
 *
 * @package WP Commerce
 * @since 1.0.0
 */

add_action( 'customize_register', 'wp_commerce_footer_settings_register' );

function wp_commerce_footer_settings_register( $wp_customize ) {
/**
     * Add Footer Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'wp_commerce_footer_settings_panel',
	    array(
	        'priority'       => 25,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Footer Settings', 'wp-commerce' ),
	    )
    );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer Social Settings
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'wp_commerce_social_links_footer_section',
    array(
        'priority'       => 1,
        'panel'          => 'wp_commerce_footer_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Social Links', 'wp-commerce' )
    )
);

/**
 * Switch option for Footer Social Links
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'wp_commerce_footer_social_option',
    array(
    	'capability'     	=> 'edit_theme_options',
        'default' 			=> 'show',
        'sanitize_callback' => 'wp_commerce_sanitize_switch_option',
    )
);
$wp_customize->add_control( new WP_Commerce_Customize_Switch_Control(
    $wp_customize,
        'wp_commerce_footer_social_option',
        array(
            'label'     	=> __( 'Social Link options', 'wp-commerce' ),
            'description'   => __( 'Show/Hide option for Footer Social Links', 'wp-commerce' ),
            'section'   	=> 'wp_commerce_social_links_footer_section',
            'settings'		=> 'wp_commerce_footer_social_option',
            'type'      	=> 'switch',
            'choices'   	=> array(
                'show'  		=> __( 'Show', 'wp-commerce' ),
                'hide'  		=> __( 'Hide', 'wp-commerce' )
            )
        )
    )
);   

// Footer Socail url
$social_name_arrays = array('Facebook','Twitter','Dribble','Linkedin');
foreach ($social_name_arrays as  $social_name) {
 	$wp_customize->add_setting( 'wp_commerce_footer_social_url_'.$social_name, array(
    'capability'            => 'edit_theme_options',
    'default'               => '',
    'sanitize_callback'     => 'esc_url_raw'
    ) );

    $wp_customize->add_control( 'wp_commerce_footer_social_url_'.$social_name, array(
        /* translators: %s: Label */ 
        'label'                 =>  sprintf( __( '%s Url', 'wp-commerce' ), $social_name ),
	    'section'               => 'wp_commerce_social_links_footer_section',
	    'type'                  => 'url',
	    'settings' => 'wp_commerce_footer_social_url_'.$social_name,
    ) );
}


/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer Payment method Settings
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'wp_commerce_payment_method_footer_section',
    array(
        'priority'       => 2,
        'panel'          => 'wp_commerce_footer_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Payment method links', 'wp-commerce' )
    )
);

/**
 * Switch option for Payment methods Links
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'wp_commerce_footer_payment_method_option',
    array(
    	'capability'     	=> 'edit_theme_options',
        'default' 			=> 'show',
        'sanitize_callback' => 'wp_commerce_sanitize_switch_option',
    )
);
$wp_customize->add_control( new WP_Commerce_Customize_Switch_Control(
    $wp_customize,
        'wp_commerce_footer_payment_method_option',
        array(
            'label'     	=> __( 'Payment method options', 'wp-commerce' ),
            'description'   => __( 'Show/Hide option for Payment method Links', 'wp-commerce' ),
            'section'   	=> 'wp_commerce_payment_method_footer_section',
            'settings'		=> 'wp_commerce_footer_payment_method_option',
            'type'      	=> 'switch',
            'choices'   	=> array(
                'show'  		=> __( 'Show', 'wp-commerce' ),
                'hide'  		=> __( 'Hide', 'wp-commerce' )
            )
        )
    )
);   

// Payment method Links
$payment_method_arrays = array('master-card'=>'Master Card','paypal'=>'Paypal','visa-card'=>'Visa Card');
	foreach ($payment_method_arrays as  $key=>$payment_method) {
	 	$wp_customize->add_setting( 'wp_commerce_footer_payment_method_url_'.$key, array(
	    'capability'            => 'edit_theme_options',
	    'default'               => '',
	    'sanitize_callback'     => 'esc_url_raw'
	    ) );

	    $wp_customize->add_control( 'wp_commerce_footer_payment_method_url_'.$key, array(
	        /* translators: %s: Label */ 
	        'label'                 =>  sprintf( __( '%s Url', 'wp-commerce' ), $payment_method ),
		    'section'               => 'wp_commerce_payment_method_footer_section',
		    'type'                  => 'url',
		    'settings' => 'wp_commerce_footer_payment_method_url_'.$key,
	    ) );
	}


/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer Newsletter form Settings
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'wp_commerce_subscribe_footer_section',
    array(
        'priority'       => 3,
        'panel'          => 'wp_commerce_footer_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Footer Subscribe', 'wp-commerce' )
    )
);

// Subscribe Form Shortcode Descriptions
$wp_customize->add_setting('wp_commerce_subscribe_shortcode',array(
	'default'      			=>      '',
	'sanitize_callback'     =>  'sanitize_text_field'
	));
$wp_customize->add_control('wp_commerce_subscribe_shortcode',array(
	'section'       =>      'wp_commerce_subscribe_footer_section',
	 'label'                 =>  __( 'Subscribe Section Use Shortcode', 'wp-commerce' ),
      /* translators: %s: Description */ 
    'description'           => sprintf( __( 'Use Newsletter Plugins shortcode: Eg: %1$s. %2$s See more here %3$s', 'wp-commerce' ), '[newsletter_form type="minimal"]','<a href="'.esc_url('https://wordpress.org/plugins/newsletter/').'" target="_blank">','</a>' ),
	'type'          =>      'text',
	'settings'		=>		'wp_commerce_subscribe_shortcode'
	));
}