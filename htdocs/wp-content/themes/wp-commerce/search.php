<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WP Commerce
 */

get_header();
?>
<section class="news blogs blog-detail block">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-sm-12">
       <?php
       if ( have_posts() ) : 
         while ( have_posts() ) :
          the_post();

          get_template_part( 'template-parts/content','search');

				// If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) :
           comments_template();
       endif;

			endwhile; // End of the loop.

      the_posts_navigation();

    else :

      get_template_part( 'template-parts/content', 'none' );

    endif;
    ?>
  </div>
  <div class="col-lg-4 col-sm-12">
    <div class="left-sidebar sidebar">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
</div>
</section>

<?php
get_footer();