<?php
/**
 * VW Ecommerce Shop Theme Customizer
 *
 * @package VW Ecommerce Shop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_ecommerce_shop_custom_controls() {

    load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_ecommerce_shop_custom_controls' );

function vw_ecommerce_shop_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_ecommerce_shop_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-ecommerce-shop' ),
	    'description' => __( 'Description of what this panel does.', 'vw-ecommerce-shop' ),
	) );

	$wp_customize->add_section( 'vw_ecommerce_shop_left_right', array(
    	'title'      => __( 'General Settings', 'vw-ecommerce-shop' ),
		'priority'   => 30,
		'panel' => 'vw_ecommerce_shop_panel_id'
	) );

	$wp_customize->add_setting('vw_ecommerce_shop_width_option',array(
        'default' => __('Full Width','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Ecommerce_Shop_Image_Radio_Control($wp_customize, 'vw_ecommerce_shop_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-ecommerce-shop'),
        'description' => __('Here you can change the width layout of Website.','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_left_right',
        'choices' => array(
            'Full Width' => get_template_directory_uri().'/images/full-width.png',
            'Wide Width' => get_template_directory_uri().'/images/wide-width.png',
            'Boxed' => get_template_directory_uri().'/images/boxed-width.png',
    ))));

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_ecommerce_shop_theme_options',array(
        'default' => __('Right Sidebar','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'	        
	) );
	$wp_customize->add_control('vw_ecommerce_shop_theme_options', array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-ecommerce-shop'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-ecommerce-shop'),
            'Right Sidebar' => __('Right Sidebar','vw-ecommerce-shop'),
            'One Column' => __('One Column','vw-ecommerce-shop'),
            'Three Columns' => __('Three Columns','vw-ecommerce-shop'),
            'Four Columns' => __('Four Columns','vw-ecommerce-shop'),
            'Grid Layout' => __('Grid Layout','vw-ecommerce-shop')
        ),
	));

	$wp_customize->add_setting('vw_ecommerce_shop_page_layout',array(
        'default' => __('One Column','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
	));
	$wp_customize->add_control('vw_ecommerce_shop_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-ecommerce-shop'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-ecommerce-shop'),
            'Right Sidebar' => __('Right Sidebar','vw-ecommerce-shop'),
            'One Column' => __('One Column','vw-ecommerce-shop')
        ),
	) );
    
	//Topbar section
	$wp_customize->add_section('vw_ecommerce_shop_topbar',array(
		'title'	=> __('Topbar Section','vw-ecommerce-shop'),
		'description'	=> __('Add Header Content here','vw-ecommerce-shop'),
		'priority'	=> null,
		'panel' => 'vw_ecommerce_shop_panel_id',
	));
	
	$wp_customize->add_setting('vw_ecommerce_shop_shipping',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_ecommerce_shop_shipping',array(
		'label'	=> __('Add Shipping Text','vw-ecommerce-shop'),
		'section'	=> 'vw_ecommerce_shop_topbar',
		'setting'	=> 'vw_ecommerce_shop_shipping',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_return',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_ecommerce_shop_return',array(
		'label'	=> __('Add Return Text','vw-ecommerce-shop'),
		'section'	=> 'vw_ecommerce_shop_topbar',
		'setting'	=> 'vw_ecommerce_shop_return',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_cash',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_ecommerce_shop_cash',array(
		'label'	=> __('Add Payment Text','vw-ecommerce-shop'),
		'section'	=> 'vw_ecommerce_shop_topbar',
		'setting'	=> 'vw_ecommerce_shop_cash',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_contact',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_ecommerce_shop_contact',array(
		'label'	=> __('Add Phone Number','vw-ecommerce-shop'),
		'section'	=> 'vw_ecommerce_shop_topbar',
		'setting'	=> 'vw_ecommerce_shop_contact',
		'type'		=> 'text'
	));
	
	//home page slider
    $wp_customize->add_section( 'vw_ecommerce_shop_slidersettings' , array(
      'title'      => __( 'Slider Settings', 'vw-ecommerce-shop' ),
      'priority'   => null,
      'panel' => 'vw_ecommerce_shop_panel_id'
    ) );

    $wp_customize->add_setting( 'vw_ecommerce_shop_slider_hide_show',
       array(
          'default' => 1,
          'transport' => 'refresh',
          'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_control( $wp_customize, 'vw_ecommerce_shop_slider_hide_show',
       array(
          'label' => esc_html__( 'Show / Hide Slider','vw-ecommerce-shop' ),
          'section' => 'vw_ecommerce_shop_slidersettings'
    )));

    for ( $count = 1; $count <= 4; $count++ ) {

    // Add color scheme setting and control.
    $wp_customize->add_setting( 'vw_ecommerce_shop_slider_page' . $count, array(
      'default'           => '',
      'sanitize_callback' => 'vw_ecommerce_shop_sanitize_dropdown_pages'
    ) );
    $wp_customize->add_control( 'vw_ecommerce_shop_slider_page' . $count, array(
      'label'    => __( 'Select Slide Image Page', 'vw-ecommerce-shop' ),
      'description' => __( 'Size of image should be (900 x 367)', 'vw-ecommerce-shop' ),
      'section'  => 'vw_ecommerce_shop_slidersettings',
      'type'     => 'dropdown-pages'
    ) );
    
    }

    //content layout
	$wp_customize->add_setting('vw_ecommerce_shop_slider_content_option',array(
        'default' => __('Left','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Ecommerce_Shop_Image_Radio_Control($wp_customize, 'vw_ecommerce_shop_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_slidersettings',
        'choices' => array(
            'Left' => get_template_directory_uri().'/images/slider-content1.png',
            'Center' => get_template_directory_uri().'/images/slider-content2.png',
            'Right' => get_template_directory_uri().'/images/slider-content3.png',
    ))));

    //Slider excerpt
	$wp_customize->add_setting( 'vw_ecommerce_shop_slider_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_ecommerce_shop_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','vw-ecommerce-shop' ),
		'section'     => 'vw_ecommerce_shop_slidersettings',
		'type'        => 'range',
		'settings'    => 'vw_ecommerce_shop_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Opacity
	$wp_customize->add_setting('vw_ecommerce_shop_slider_opacity_color',array(
      'default'              => 0.5,
      'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
	));

	$wp_customize->add_control( 'vw_ecommerce_shop_slider_opacity_color', array(
	'label'       => esc_html__( 'Slider Image Opacity','vw-ecommerce-shop' ),
	'section'     => 'vw_ecommerce_shop_slidersettings',
	'type'        => 'select',
	'settings'    => 'vw_ecommerce_shop_slider_opacity_color',
	'choices' => array(
      '0' =>  esc_attr('0','vw-ecommerce-shop'),
      '0.1' =>  esc_attr('0.1','vw-ecommerce-shop'),
      '0.2' =>  esc_attr('0.2','vw-ecommerce-shop'),
      '0.3' =>  esc_attr('0.3','vw-ecommerce-shop'),
      '0.4' =>  esc_attr('0.4','vw-ecommerce-shop'),
      '0.5' =>  esc_attr('0.5','vw-ecommerce-shop'),
      '0.6' =>  esc_attr('0.6','vw-ecommerce-shop'),
      '0.7' =>  esc_attr('0.7','vw-ecommerce-shop'),
      '0.8' =>  esc_attr('0.8','vw-ecommerce-shop'),
      '0.9' =>  esc_attr('0.9','vw-ecommerce-shop')
	),
	));

	//Trending Product
	$wp_customize->add_section('vw_ecommerce_shop_products',array(
		'title'	=> __('Trending Products','vw-ecommerce-shop'),
		'description'=> __('This section will appear below the slider.','vw-ecommerce-shop'),
		'panel' => 'vw_ecommerce_shop_panel_id',
	));	
	
	$wp_customize->add_setting('vw_ecommerce_shop_maintitle',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_ecommerce_shop_maintitle',array(
		'label'	=> __('Section Title','vw-ecommerce-shop'),
		'section'=> 'vw_ecommerce_shop_products',
		'setting'=> 'vw_ecommerce_shop_maintitle',
		'type'=> 'text'
	));	

	for ( $count = 0; $count <= 0; $count++ ) {

		$wp_customize->add_setting( 'vw_ecommerce_shop_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_ecommerce_shop_sanitize_dropdown_pages'
		));
		$wp_customize->add_control( 'vw_ecommerce_shop_page' . $count, array(
			'label'    => __( 'Select Page', 'vw-ecommerce-shop' ),
			'section'  => 'vw_ecommerce_shop_products',
			'type'     => 'dropdown-pages'
		));
	}

	//Blog Post
	$wp_customize->add_section('vw_ecommerce_shop_blog_post',array(
		'title'	=> __('Blog Post Settings','vw-ecommerce-shop'),
		'panel' => 'vw_ecommerce_shop_panel_id',
	));	

	$wp_customize->add_setting( 'vw_ecommerce_shop_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_control( $wp_customize, 'vw_ecommerce_shop_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','vw-ecommerce-shop' ),
        'section' => 'vw_ecommerce_shop_blog_post'
    )));

    $wp_customize->add_setting( 'vw_ecommerce_shop_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_control( $wp_customize, 'vw_ecommerce_shop_toggle_author',array(
		'label' => esc_html__( 'Author','vw-ecommerce-shop' ),
		'section' => 'vw_ecommerce_shop_blog_post'
    )));

    $wp_customize->add_setting( 'vw_ecommerce_shop_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_control( $wp_customize, 'vw_ecommerce_shop_toggle_comments',array(
		'label' => esc_html__( 'Comments','vw-ecommerce-shop' ),
		'section' => 'vw_ecommerce_shop_blog_post'
    )));

    $wp_customize->add_setting( 'vw_ecommerce_shop_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_ecommerce_shop_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-ecommerce-shop' ),
		'section'     => 'vw_ecommerce_shop_blog_post',
		'type'        => 'range',
		'settings'    => 'vw_ecommerce_shop_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Content Creation
	$wp_customize->add_section( 'vw_ecommerce_shop_content_section' , array(
    	'title' => __( 'Customize Home Page Settings', 'vw-ecommerce-shop' ),
		'priority' => null,
		'panel' => 'vw_ecommerce_shop_panel_id'
	) );

	$wp_customize->add_setting('vw_ecommerce_shop_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new VW_Ecommerce_Shop_Content_Creation( $wp_customize, 'vw_ecommerce_shop_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-ecommerce-shop' ),
		),
		'section' => 'vw_ecommerce_shop_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-ecommerce-shop' ),
	) ) );

	//Footer Text
	$wp_customize->add_section('vw_ecommerce_shop_footer',array(
		'title'	=> __('Footer','vw-ecommerce-shop'),
		'description'=> __('This section will appear in the footer','vw-ecommerce-shop'),
		'panel' => 'vw_ecommerce_shop_panel_id',
	));	
	
	$wp_customize->add_setting('vw_ecommerce_shop_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_ecommerce_shop_footer_text',array(
		'label'	=> __('Copyright Text','vw-ecommerce-shop'),
		'section'=> 'vw_ecommerce_shop_footer',
		'setting'=> 'vw_ecommerce_shop_footer_text',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('vw_ecommerce_shop_scroll_top_alignment',array(
        'default' => __('Right','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Ecommerce_Shop_Image_Radio_Control($wp_customize, 'vw_ecommerce_shop_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_footer',
        'settings' => 'vw_ecommerce_shop_scroll_top_alignment',
        'choices' => array(
            'Left' => get_template_directory_uri().'/images/layout1.png',
            'Center' => get_template_directory_uri().'/images/layout2.png',
            'Right' => get_template_directory_uri().'/images/layout3.png'
    ))));
}

add_action( 'customize_register', 'vw_ecommerce_shop_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo-resizer.php' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Ecommerce_Shop_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Ecommerce_Shop_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new VW_Ecommerce_Shop_Customize_Section_Pro($manager,'example_1', array(
			'priority'   => 1,
			'title'    => esc_html__( 'VW Ecommerce Pro', 'vw-ecommerce-shop' ),
			'pro_text' => esc_html__( 'Upgrade Pro','vw-ecommerce-shop' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/premium/ecommerce-wordpress-theme/')
		)));

		// Register sections.
		$manager->add_section(new VW_Ecommerce_Shop_Customize_Section_Pro($manager,'example_2',array(
			'priority'   =>1,
			'title'    => esc_html__( 'Documentation', 'vw-ecommerce-shop' ),
			'pro_text' => esc_html__( 'Docs', 'vw-ecommerce-shop' ),
			'pro_url'  => esc_url( 'themes.php?page=vw_ecommerce_shop_guide')
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-ecommerce-shop-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-ecommerce-shop-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Ecommerce_Shop_Customize::get_instance();