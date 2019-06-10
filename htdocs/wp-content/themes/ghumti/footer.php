<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

?>

</div><!-- .at-container -->
</div><!-- #content -->

<?php
		/**
	     * ghumti_footer hook
	     * @hooked - ghumti_footer_start - 5
	     * @hooked - ghumti_top_footer_widget_section - 10
	     * @hooked - ghumti_main_footer_start - 15
	     * @hooked - ghumti_footer_menu_section - 20
	     * @hooked - ghumti_footer_site_info_section - 25
	     * @hooked - ghumti_main_footer_widget_section - 30
	     * @hooked - ghumti_footer_menu_section - 35
	     * @hooked - ghumti_bottom_footer_end - 40
	     * @hooked - ghumti_footer_end - 45
	     *
	     * @since 1.0.0
	     */
		do_action( 'ghumti_footer' );
		?>
	</div><!-- #page -->

	<?php
	/**
     * ghumti_after_page hook
     *
     * @since 1.0.0
     */
	do_action( 'ghumti_after_page' );
	?>

	<?php wp_footer(); ?>

</body>
</html>