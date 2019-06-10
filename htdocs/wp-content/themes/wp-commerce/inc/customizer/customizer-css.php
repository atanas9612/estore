<?php 
function wp_commerce_color_css(){
?>
<style type="text/css">
<?php if(get_theme_mod('wp_commerce_primary_theme_color')):?>
.t-header, .m-header {
	background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_primary_theme_color' ));?>;
}

.feature-product{
	background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_primary_theme_color' ));?>;
}

.sidebar .price-range .ui-slider-horizontal .ui-slider-handle {
    background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_primary_theme_color' ));?>;
}

.sidebar .price-range .ui-widget-header{
	background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_primary_theme_color' ));?>;
}

.sidebar .sizes ul li a:hover{
	border-color:<?php echo esc_attr(get_theme_mod( 'wp_commerce_primary_theme_color' ));?>;
	color:  <?php echo esc_attr(get_theme_mod( 'wp_commerce_primary_theme_color' ));?>;
}

.sidebar .sizes ul li.active a{
	border-color:  <?php echo esc_attr(get_theme_mod( 'wp_commerce_primary_theme_color' ));?>;
	color: <?php echo esc_attr(get_theme_mod( 'wp_commerce_primary_theme_color' ));?>;
}

.m-header .cart{
	background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_primary_theme_color' ));?>;
}
.services .card{
 background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_primary_theme_color' ));?>;
}
<?php endif;?>

<?php if(get_theme_mod( 'wp_commerce_secondary_theme_color' )):?>
.m-header .cart .dropdown .btn .badge{ 
    background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
}

.m-header .mini-cart-media .cart-checkout .btn{
	background:<?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
}
.product .card .card-body .option li a.active{
	background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
}
.product .card .card-body .option li a:hover{
	background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
}

.news .card .card-body .btn{
	background:<?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
}

.contact-form form .btn{
	background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
}

.sidebar .blog-search .btn{
	background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
}

.blog-detail .comments .comments-form .form-holder .btn{
	background:<?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
}

.sidebar .price-range .btn{
	background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
}

.pagination li a:hover{
	background-color: <?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
	border-color:<?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
}
.product-detail .p-detail .btm-block .btn-primary{
	background: <?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
}

.product-detail .p-detail .btm-block .btn-secondary:hover{
	background:<?php echo esc_attr(get_theme_mod( 'wp_commerce_secondary_theme_color' ));?>;
}
<?php endif;?>	
</style>
<?php }
add_action('wp_head','wp_commerce_color_css');