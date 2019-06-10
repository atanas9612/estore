<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

			the_post_navigation();

			/**
		     * ghumti_related_posts hook
		     *
		     * @hooked - ghumti_related_posts_start - 5
		     * @hooked - ghumti_related_posts_section - 10
		     * @hooked - ghumti_related_posts_end - 15
		     *
		     * @since 1.0.0
		     */
			
			do_action( 'ghumti_related_posts' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
ghumti_get_sidebar();
get_footer();