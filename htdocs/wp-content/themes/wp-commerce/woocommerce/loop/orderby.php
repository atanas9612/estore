<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
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

?>

<div class="sortby">
 	<form class="woocommerce-ordering form-inline sortby-form ml-auto" method="get">
	<div class="form-group">
		<label><?php esc_html_e('Sort By:','wp-commerce');?> </label>
		<div class="selectdiv ">
			<label>
				<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
				<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
					<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
				<?php endforeach; ?>
				</select>
			</label>
			<input type="hidden" name="paged" value="1" />
			<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
		</div>
		<?php 	wp_commerce_result_count_shop_loop();?>
	</div>
</form>
</div>
