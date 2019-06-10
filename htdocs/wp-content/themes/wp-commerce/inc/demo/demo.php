<?php
/**
 * Demo configuration
 *
 * @package WP Commerce
 */

$config = array(
	'static_page'    => 'home',
	'posts_page'     => 'blog',
	'menu_locations' => array(
		'primary' 	=> 'primary',
		'side_menu'	=>'sidemenu',
		'social'	=>'socialmenu',
	),
	'ocdi'           => array(
		array(
			'import_file_name'             => esc_html__( 'Import WP Commerce Demo', 'wp-commerce' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo/contents.xml',
      		'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo/widgets.wie',
      		'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo/customizer.dat',
      		'import_notice'                => __( 'It will overwrite your settings', 'wp-commerce' ),
      		'preview_url'                  => 'https://wpcodethemes.com/wp-commerce/',
		),
		
	),
);

WP_Commerce_Demo::init( apply_filters( 'wp_commerce_demo_filter', $config ) );