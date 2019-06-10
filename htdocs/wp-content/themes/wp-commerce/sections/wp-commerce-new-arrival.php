<?php $wp_commerce_frontpage_new_arrivals_option = get_theme_mod( 'wp_commerce_frontpage_new_arrivals_option', 'show' );
if( $wp_commerce_frontpage_new_arrivals_option == 'show' ) :?>
<section class="new-arrival block">
    <div class="container">
        <div class="main-title">
            <h4><?php echo esc_html(get_theme_mod('wp_commerce_frontpage_new_arrivals_text'));?></h4>
        </div>
        <div class="product-holder">
            <div class="row">
                 <?php if ( is_active_sidebar( 'new-arrivals' ) ) : 
                    dynamic_sidebar('new-arrivals'); 
                    endif;
                ?>  
            </div>
        </div>
    </div>
</section>
<?php endif;?>