<?php
/**
 * About configuration
 *
 * @package WP Commerce
 */

$config = array(
	'menu_name' => esc_html__( 'WP Commerce Setup', 'wp-commerce' ),
	'page_name' => esc_html__( 'WP Commerce Setup', 'wp-commerce' ),

	/* translators: theme version */
	'welcome_title' => sprintf( esc_html__( 'Welcome to %s - ', 'wp-commerce' ), 'WP Commerce' ),

	/* translators: 1: theme name */
	'welcome_content' => sprintf( esc_html__( 'We hope this page will help you to setup %1$s with few clicks. We believe you will find it easy to use and perfect for your website development.', 'wp-commerce' ), 'WP Commerce' ),

	// Quick links.
	'quick_links' => array(
		'theme_url' => array(
			'text' => esc_html__( 'Theme Details','wp-commerce' ),
			'url'  => 'https://wpcodethemes.com/downloads/wp-commerce/',
		),
		'demo_url' => array(
			'text' => esc_html__( 'View Demo','wp-commerce' ),
			'url'  => 'https://wpcodethemes.com/wp-commerce',
		),
		'documentation_url' => array(
			'text'   => esc_html__( 'Documentation','wp-commerce' ),
			'url'    => 'https://wpcodethemes.com/wp-content/uploads/2018/07/WP-Commerce.pdf',
		),
		'upgrade_url' => array(
			'text'   => esc_html__( 'Upgrade to Pro','wp-commerce' ),
			'url'    => 'https://wpfactory.com/item/wp-commerce-theme-for-woocommerce/',
			'button' => 'primary'
		),
	),

	// Tabs.
	'tabs' => array(
		'getting_started'     => esc_html__( 'Getting Started', 'wp-commerce' ),
		'recommended_actions' => esc_html__( 'Recommended Actions', 'wp-commerce' ),
		'support'             => esc_html__( 'Support', 'wp-commerce' ),
	),

	// Getting started.
	'getting_started' => array(
		array(
			'title'               => esc_html__( 'Theme Documentation', 'wp-commerce' ),
			'text'                => esc_html__( 'Find step by step instructions to setup theme easily.', 'wp-commerce' ),
			'button_label'        => esc_html__( 'View documentation', 'wp-commerce' ),
			'button_link'         => 'https://wpcodethemes.com/downloads/wp-commerce',
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		array(
			'title'               => esc_html__( 'Recommended Actions', 'wp-commerce' ),
			'text'                => esc_html__( 'We recommend few steps to take so that you can get complete site like shown in demo.', 'wp-commerce' ),
			'button_label'        => esc_html__( 'Check recommended actions', 'wp-commerce' ),
			'button_link'         => esc_url( admin_url( 'themes.php?page=wp-commerce-about&tab=recommended_actions' ) ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
		array(
			'title'               => esc_html__( 'Customize Everything', 'wp-commerce' ),
			'text'                => esc_html__( 'Start customizing every aspect of the website with customizer.', 'wp-commerce' ),
			'button_label'        => esc_html__( 'Go to Customizer', 'wp-commerce' ),
			'button_link'         => esc_url( wp_customize_url() ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
	),

	// Recommended actions.
	'recommended_actions' => array(
		'content' => array(
			'woocommerce' => array(
				'title'       => esc_html__( 'Woocommerce', 'wp-commerce' ),
				'description' => esc_html__( 'Please install the Woocommerce plugin to add products and setup wp commerce theme. After activation go to Appearance >> WooCommerce.', 'wp-commerce' ),
				'check'       => class_exists( 'OCDI_Plugin' ),
				'plugin_slug' => 'woocommerce',
				'id'          => 'woocommerce',
			),

			'woocommerce-jetpack' => array(
				'title'       => esc_html__( 'WooCommerce Jetpack', 'wp-commerce' ),
				'description' => esc_html__( 'Please install the WooCommerce Jetpack plugin to setup Prices & Currencies of product. After activation go to Appearance >> Booster Settings.', 'wp-commerce' ),
				'check'       => class_exists( 'OCDI_Plugin' ),
				'plugin_slug' => 'woocommerce-jetpack',
				'id'          => 'woocommerce-jetpack',
			),
			'front-page' => array(
				'title'       => esc_html__( 'Setting Static Front Page','wp-commerce' ),
				'description' => esc_html__( 'Create a new page to display on front page ( Ex: Home ) and assign "Home" template. Select A static page then Front page and Posts page to display front page specific sections. Note: Static page will be set automatically when you import demo content.', 'wp-commerce' ),
				'id'          => 'front-page',
				'check'       => ( 'page' === get_option( 'show_on_front' ) ) ? true : false,
				'help'        => '<a href="' . esc_url( wp_customize_url() ) . '?autofocus[section]=static_front_page" class="button button-secondary">' . esc_html__( 'Static Front Page', 'wp-commerce' ) . '</a>',
			),
			'contact-form-7' => array(
				'title'       => esc_html__( 'Contact Form 7', 'wp-commerce' ),
				'description' => esc_html__( 'Please install the Contact Form 7 plugin Before Importing Demo.', 'wp-commerce' ),
				'check'       => class_exists( 'OCDI_Plugin' ),
				'plugin_slug' => 'contact-form-7',
				'id'          => 'contact-form-7',
			),
			'newsletter' => array(
				'title'       => esc_html__( 'NewsLetter Plugin', 'wp-commerce' ),
				'description' => esc_html__( 'Please install the Newsletter Plugin Before Importing Demo.', 'wp-commerce' ),
				'check'       => class_exists( 'OCDI_Plugin' ),
				'plugin_slug' => 'newsletter',
				'id'          => 'newsletter',
			),

			'one-click-demo-import' => array(
				'title'       => esc_html__( 'One Click Demo Import', 'wp-commerce' ),
				'description' => esc_html__( 'Please install the One Click Demo Import plugin to import the demo content. After activation go to Appearance >> Import Demo Data and import it.', 'wp-commerce' ),
				'check'       => class_exists( 'OCDI_Plugin' ),
				'plugin_slug' => 'one-click-demo-import',
				'id'          => 'one-click-demo-import',
			),
		),
	),

	// Support.
	'support_content' => array(
		'first' => array(
			'title'        => esc_html__( 'Contact Support', 'wp-commerce' ),
			'icon'         => 'dashicons dashicons-sos',
			'text'         => esc_html__( 'If you have any problem, feel free to create ticket on our dedicated Support forum.', 'wp-commerce' ),
			'button_label' => esc_html__( 'Contact Support', 'wp-commerce' ),
			'button_link'  => esc_url( 'https://wpcodethemes.com/downloads/wp-commerce' ),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'second' => array(
			'title'        => esc_html__( 'Theme Documentation', 'wp-commerce' ),
			'icon'         => 'dashicons dashicons-book-alt',
			'text'         => esc_html__( 'Kindly check our theme documentation for detailed information and video instructions.', 'wp-commerce' ),
			'button_label' => esc_html__( 'View Documentation', 'wp-commerce' ),
			'button_link'  => 'https://wpcodethemes.com/wp-content/uploads/2018/07/WP-Commerce.pdf',
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'third' => array(
			'title'        => esc_html__( 'Customization Request', 'wp-commerce' ),
			'icon'         => 'dashicons dashicons-admin-tools',
			'text'         => esc_html__( 'This is 100% free theme and has premium version.Either Upgrade to Pro or  Feel free to contact us any time if you need any customization service.', 'wp-commerce' ),
			'button_label' => esc_html__( 'Upgrade to Pro', 'wp-commerce' ),
			'button_link'  => 'https://wpfactory.com/item/wp-commerce-theme-for-woocommerce/',
			'is_button'    => true,
			'is_new_tab'   => true,
		),
	),


);
WP_Commerce_About::init( apply_filters( 'wp_commerce_about_filter', $config ) );