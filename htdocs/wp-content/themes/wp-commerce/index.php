<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP Commerce
 */

get_header();

?>
<section class="news blogs block">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-12">
          <div class="row">
            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
                /*
                 * Include the Post-Type-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', get_post_type() );
            endwhile;?>
          </div>
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
