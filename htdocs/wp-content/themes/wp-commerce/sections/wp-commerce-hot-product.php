<?php $wp_commerce_frontpage_hot_products_option = get_theme_mod( 'wp_commerce_frontpage_hot_products_option', 'show' );
if( $wp_commerce_frontpage_hot_products_option == 'show' ) :?>
<section class="hot-product block">
    <div class="container">
        <div class="main-title">
            <h4><?php echo esc_html(get_theme_mod('wp_commerce_frontpage_hot_products_text'));?></h4>
        </div>
        <div class="product-holder">
            <div class="row">
                <?php if ( is_active_sidebar( 'hot-products' ) ) : 
                        dynamic_sidebar('hot-products'); 
                        endif;
                ?>  
            </div>
        </div>
    </div>
</section>
<?php endif;?>