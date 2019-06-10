
<?php $wp_commerce_frontpage_promo_option = get_theme_mod( 'wp_commerce_frontpage_promo_option', 'show' );
if( $wp_commerce_frontpage_promo_option == 'show' ) :?>
<section class="banner-btm block">
    <div class="container">
        <div class="row">
            <?php wp_commerce_promo_items();?>
        </div>
    </div>
</section>
<?php endif;?>