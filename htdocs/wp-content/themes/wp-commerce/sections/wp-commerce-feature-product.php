<?php $wp_commerce_frontpage_feature_product_option = get_theme_mod( 'wp_commerce_frontpage_feature_product_option', 'show' );
if( $wp_commerce_frontpage_feature_product_option == 'show' ) :?>
<section class="feature-product">
    <div class="container">
        <div class="main-title">
            <h4><?php echo esc_html( get_theme_mod( 'wp_commerce_frontpage_feature_product_text' ));?></h4>
        </div>
        <div class="product-holder">
            <div class="row">
                <?php if ( is_active_sidebar( 'feature-product' ) ) : 
                        dynamic_sidebar('feature-product'); 
                        endif;
                ?>  
        
            </div>
        </div>
    </div>
</section>
<?php endif;?>