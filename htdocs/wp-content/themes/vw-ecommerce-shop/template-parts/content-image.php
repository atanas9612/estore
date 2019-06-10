<?php
/**
 * The template part for displaying image post
 *
 * @package VW Ecommerce Shop 
 * @subpackage vw_ecommerce_shop
 * @since VW Ecommerce Shop 1.0
 */
?>

<?php
 $vw_ecommerce_shop_toggle_postdate = get_theme_mod( 'vw_ecommerce_shop_toggle_postdate' );
 if ( 'Disable' == $vw_ecommerce_shop_toggle_postdate ) {
   $colmd = 'col-lg-12 col-md-12';
 } else { 
   $colmd = 'col-lg-10 col-md-9';
 } 
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="post-main-box">
    <div class="box-image">
      <?php 
        if(has_post_thumbnail()) { 
          the_post_thumbnail(); 
        }
      ?>  
    </div>
    <div class="row">
      <?php if ( 'Disable' != $vw_ecommerce_shop_toggle_postdate ) {?>
        <div class="col-lg-2 col-md-3">
          <div class="datebox">
            <div class="date-monthwrap">
              <span class="date-month"><?php echo esc_html( get_the_date( 'M' ) ); ?></span>
              <span class="date-day"><?php echo esc_html( get_the_date( 'd') ); ?></span>
            </div>
            <div class="yearwrap">
              <span class="date-year"><?php echo esc_html( get_the_date( 'Y' ) ); ?></span>
            </div>
          </div>
        </div>
      <?php } ?>
      <div class="<?php echo esc_html( $colmd ); ?>">
        <h3 class="section-title"><?php the_title();?></h3>
        <div class="new-text">
          <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_ecommerce_shop_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_ecommerce_shop_excerpt_number','30')))); ?></p>
        </div>
        <div class="content-bttn">
          <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small hvr-sweep-to-right" title="<?php esc_attr_e( 'Read More', 'vw-ecommerce-shop' ); ?>"><?php esc_html_e('Read More','vw-ecommerce-shop'); ?></a>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>