<?php
/*
* Template Name: FrontPage
*/	
get_header();	

get_template_part( 'sections/wp-commerce','banner' );
get_template_part( 'sections/wp-commerce','banner-btm' );
get_template_part( 'sections/wp-commerce','feature-product' );
get_template_part( 'sections/wp-commerce','new-arrival' );
get_template_part( 'sections/wp-commerce','hot-product' );
get_template_part( 'sections/wp-commerce','services' );
get_template_part( 'sections/wp-commerce','news' );

get_footer(); 