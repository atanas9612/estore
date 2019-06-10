	<?php
	/**
	* The template for displaying product content in the single-product.php template
	*
	* This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
	*
	* HOWEVER, on occasion WooCommerce will need to update template files and you
	* (the theme developer) will need to copy the new files to your theme to
	* maintain compatibility. We try to do this as little as possible, but it does
	* happen. When this occurs the version of the template file will be bumped and
	* the readme will list any important changes.
	*
	* @see 	    https://docs.woocommerce.com/document/template-structure/
	* @author 		wpcodethemes
	* @package 	WooCommerce/Templates
	* @version     3.6.0
	*/

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	global $product;

	/**
	* Hook Woocommerce_before_single_product.
	*
	* @hooked wc_print_notices - 10
	*/
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div class="product-detail" id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="row">
		<div class="col-md-5">
			<div id="product__slider">
				<div class="product__slider-main">
					<div class="slide zoom">
						<?php wp_commerce_show_product_images();?>
					</div>
				</div>
				<div class="product__slider-thmb">
					<?php woocommerce_show_product_thumbnails(); ?>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="p-detail">
				<div class="t-content">
					<?php wp_commerce_template_single_meta();?>
					<?php wp_commerce_template_single_title();?>
					<?php wp_commerce_template_single_rating();?>
				</div>
				<?php wp_commerce_template_loop_price();?>
				<?php wp_commerce_template_single_excerpt();?>
				<?php wp_commerce_template_single_add_to_cart();?>
			</div>
		</div>
	</div>
	<?php $tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
	<div class="p-tab">
		<ul class="nav nav-tabs" id="mytab" role="tablist">
			<?php foreach ( $tabs as $key => $tab ) : ?>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="home" aria-selected="true"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="tab-content" id="myTabContent">
			<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="tab-pane fade show active" id="<?php echo esc_attr( $key ); ?>" role="tabpanel">
				<?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
</div>
</div>
