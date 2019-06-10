<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WP Commerce
 */

get_header();
?>
<section class="news blogs block">
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card-body">
          <h1 class="t-text"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wp-commerce' ); ?></h1>
         
          <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wp-commerce' ); ?></p>
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
