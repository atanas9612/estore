<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays all widgets included in homepage widget area.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

get_header(); 

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Home Middle Section Area
 * 
 * @since 1.0.0
 */
if ( is_active_sidebar( 'ghumti_home_middle_section_area' ) ) {
	?>
	<div class="ghumti-home-middle-section ghumti-clearfix">
		<?php dynamic_sidebar( 'ghumti_home_middle_section_area' ); ?>
	</div><!-- .ghumti-home-middle-section -->
	<?php 
}

get_footer();