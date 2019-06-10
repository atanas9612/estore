<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'ghumti_left_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'ghumti_left_sidebar' ); ?>
</aside><!-- #secondary -->
