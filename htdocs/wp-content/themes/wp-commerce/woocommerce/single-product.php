<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see       https://docs.woocommerce.com/document/template-structure/
 * @author    wpcodethemes
 * @package   WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );?>
<div class="col-lg-3 col-md-12">
  <div class="right-sidebar sidebar">
    <?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>    
      <!-- Single Table -->
          <?php dynamic_sidebar( 'shop-sidebar' ); ?>
      <!-- End Single Table-->
    <?php endif; ?>
  </div>
</div>
<div class="col-lg-9 col-md-12">
  <?php while ( have_posts() ) : the_post(); ?>

      <?php wc_get_template_part( 'content', 'single-product' ); ?>

    <?php endwhile; // end of the loop. ?>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );?>
</div>
<?php

get_footer('shop');
