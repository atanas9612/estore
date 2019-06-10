<?php
/**
 * woocommerce.php
 *
 * @version 1.1.0
 */

/**
 * woocommerce archive product page hooks overwrite start
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


add_action( 'woocommerce_before_main_content', 'wp_commerce_before_main_content', 10 );
add_action( 'woocommerce_after_main_content', 'wp_commerce_after_main_content', 10 );
add_action( 'woocommerce_before_shop_loop', 'wp_commerce_catalog_ordering', 30 );
add_action( 'woocommerce_shop_loop_item_title', 'wp_commerce_template_loop_product_title', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'wp_commerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'wp_commerce_template_loop_add_to_cart', 10 );

function wp_commerce_before_main_content()
{?>
	<section class="product-list block"> <div class="container">
		<div class="row">
		<?php }

		function wp_commerce_after_main_content()
		{?>
		</section></div></div>
		<?php
	}


	function wp_commerce_result_count_shop_loop(){
		if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
			return;
		}
		$args = array(
			'total'    => wc_get_loop_prop( 'total' ),
			'per_page' => wc_get_loop_prop( 'per_page' ),
			'current'  => wc_get_loop_prop( 'current_page' ),
		);

		wc_get_template( 'loop/result-count.php', $args );
	}

	function wp_commerce_catalog_ordering(){
		if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
			return;
		}
		$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
		$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
			'menu_order' => __( 'Default sorting', 'wp-commerce' ),
			'popularity' => __( 'Sort by popularity', 'wp-commerce' ),
			'rating'     => __( 'Sort by average rating', 'wp-commerce' ),
			'date'       => __( 'Sort by newness', 'wp-commerce' ),
			'price'      => __( 'Sort by price: low to high', 'wp-commerce' ),
			'price-desc' => __( 'Sort by price: high to low', 'wp-commerce' ),
		) );

		$default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );
		$orderby         = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

		if ( wc_get_loop_prop( 'is_search' ) ) {
			$catalog_orderby_options = array_merge( array( 'relevance' => __( 'Relevance', 'wp-commerce' ) ), $catalog_orderby_options );

			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( ! $show_default_orderby ) {
			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
			unset( $catalog_orderby_options['rating'] );
		}

		if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
			$orderby = current( array_keys( $catalog_orderby_options ) );
		}

		wc_get_template( 'loop/orderby.php', array(
			'catalog_orderby_options' => $catalog_orderby_options,
			'orderby'                 => $orderby,
			'show_default_orderby'    => $show_default_orderby,
		) );
	}

	function wp_commerce_template_loop_product_title(){
		global $product;
		?>
		<a href="<?php esc_url(the_permalink());?>"><h6><?php echo esc_html(get_the_title());?></h6></a>
		<?php $terms =  get_the_terms( $product->get_id(), 'product_cat' );
		if ( $terms && ! is_wp_error( $terms ) ) {?>
			<span class="category"><?php echo esc_html($terms[0]->name);?></span>
		<?php }?>
	<?php }

	function wp_commerce_template_loop_price(){?>
		<div class="price-tag">
			<?php
			global $woocommerce;
			$currency = get_woocommerce_currency_symbol();
			$price = get_post_meta( get_the_ID(), '_regular_price', true);
			$sale = get_post_meta( get_the_ID(), '_sale_price', true);
			?>
			<p>
				<?php if($sale) : ?>
					<span class="discount-tag"><?php echo esc_html($currency); echo esc_html($price); ?></span> <?php echo esc_html($currency); echo esc_html($sale); ?>

					<?php elseif($price) : ?>
						<span class="discount-tag"><?php echo esc_html($currency); echo esc_html($price); ?></span>
					<?php endif; ?>
				</p>
			</div>
		<?php }

		function wp_commerce_template_loop_add_to_cart(){?>
			<ul class="option">
				<li>
					<?php global $product;?>
					<a href="<?php echo esc_url( $product->add_to_cart_url() );?>" class="active" title="Add to cart"><span class="fa fa-shopping-cart"></span></a>
				</li>
				<li>
					<a href="<?php esc_url(the_permalink());?>" title="View"><span class="fa fa-eye"></span></a>
				</li>
			</ul>
			<?php
		}
/*
* archieve product page hooks overwirte end
*/

/*
* Overwrite Product single Page Start
*/
function wp_commerce_show_product_images(){
	global $product;
	$post_thumbnail_id = $product->get_id();
	$product_thumb_url = get_the_post_thumbnail_url($post_thumbnail_id,'wp-commerce-single-product-thumb-379*-379');
	?>
	<img src="<?php echo esc_url($product_thumb_url);?>" alt="">
	<?php
}
function wp_commerce_output_related_products(){

	global $product;
	$args = array(
		'posts_per_page' => 4,
		'columns'        => 4,
			'orderby'        => 'rand', // @codingStandardsIgnoreLine.
		);
	if ( ! $product ) {
		return;
	}

	$defaults = array(
		'posts_per_page' => 6,
			'orderby'        => 'rand', // @codingStandardsIgnoreLine.
			'order'          => 'desc',
		);

	$args = wp_parse_args( $args, $defaults );

		// Get visible related products then sort them at random.
	$args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );

		// Handle orderby.
	$args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

		// Set global loop values.
	wc_set_loop_prop( 'name', 'related' );

	wc_get_template( 'single-product/related.php', $args );
}

function wp_commerce_template_single_meta(){
	global $product;
	echo wc_get_product_category_list( esc_html($product->get_id()), ', ', '<span class="category">' . ' ', '</span>' );
}

function wp_commerce_template_single_title(){
	the_title( '<h5>', '</h5>' );
}

function wp_commerce_template_single_rating(){
	global $product;
	if ( post_type_supports( 'product', 'comments' ) ) {
		if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
			return;
		}

		$rating_count = $product->get_rating_count();
		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating();
	}
	if ( $rating_count > 0 ) : ?>
		<div class="woocommerce-product-rating">
			<?php echo wc_get_rating_html( $average, $rating_count ); ?>
			<?php if ( comments_open() ) : ?><?php
				//translators: %s: review count.
				printf( _n( '%s customer review', '%s customer reviews', $review_count, 'wp-commerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?><a href="#reviews" class="add"><?php esc_html_e('Add a review','wp-commerce');?></a><?php endif ?>
			</div>
			<?php
		endif;
	}

	function wp_commerce_template_single_excerpt(){
		global $post;

		$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

		if ( ! $short_description ) {
			return;
		}?>
		<div class="woocommerce-product-details__short-description">
			<?php echo $short_description; // WPCS: XSS ok. ?>
		</div>
		<?php
	}

	/**
	 * wp_commerce_template_single_add_to_cart
	 *
	 * @version 1.1.0
	 */
	function wp_commerce_template_single_add_to_cart(){
		global $product;

		if ( $product->is_type( 'variable' ) ) {
			woocommerce_variable_add_to_cart();
			return;
		}

		if ( ! $product->is_purchasable() ) {
			return;
		}

		echo wc_get_stock_html( $product );

		if ( $product->is_in_stock() ) : ?>

			<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

			<form class="detail-select cart" action="<?php echo esc_url( get_permalink() ); ?>" method="post" enctype='multipart/form-data'>
				<?php
			/**
			 * @since 2.1.0.
			 */
			do_action( 'woocommerce_before_add_to_cart_button' );

			/**
			 * @since 3.0.0.
			 */
			do_action( 'woocommerce_before_add_to_cart_quantity' );

			woocommerce_quantity_input( array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
			) );

			/**
			 * @since 3.0.0.
			 */
			do_action( 'woocommerce_after_add_to_cart_quantity' );
			?>

			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

			<?php
			/**
			 * @since 2.1.0.
			 */
			do_action( 'woocommerce_after_add_to_cart_button' );
			?>
		</form>

		<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

	<?php endif; ?>
	<?php
}
/*
* Overwrte Product single Page End
*/

function wp_commerce_add_to_cart_dropdown(){?>
	<div class="cart">
		<?php
		global $woocommerce;
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		$cart_url = esc_url(wc_get_cart_url());
		?>
		<div class="dropdown">
			<div class="btn mini-cart">
				<a href="<?php echo esc_url($cart_url);?>" class="cart-btn">
					<img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/cart.png" alt="">
					<span class="badge badge-light"><?php echo absint( $cart_contents_count );?></span>
					<span class="fa fa-angle-down drop-arrow"></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<?php if ( ! WC()->cart->is_empty() ) : ?>
					<div class="mini-cart-media">
						<?php
						foreach( WC()->cart->cart_contents as $cart_item_key => $cart_item ):
							$item = $cart_item['data'];
							$item_id = $item->get_id();
							$item_name = $item->get_name();
							$qty = $cart_item['quantity'];
							?>
							<div class="media">
								<?php
								if ( has_post_thumbnail( $item_id ) ) {
									$product_image_url  = get_the_post_thumbnail_url($item_id, 'wp-commerce-mini-cart-thumb-80*-80');?>
									<img class="mr-3" src="<?php echo esc_url( $product_image_url);?>" alt="">
								<?php } else {?>
									<img src="http://via.placeholder.com/80x80')" alt="Placeholder" width="80px" height="80px" class="mr-3"/>
								<?php }?>
								<div class="media-body">

									<a href="<?php echo esc_url(get_permalink($item_id));?>"><h6 class="mt-0"><?php echo esc_html($item_name);?></h6></a>
									<div class="price-tag">
										<?php $currency = get_woocommerce_currency_symbol();?>
										<p><span class="discount-tag"><?php echo esc_html($currency); echo esc_html(get_post_meta($item_id, '_regular_price', true));?></span><?php echo esc_html($currency);echo esc_html(get_post_meta($item_id , '_sale_price', true));?></p>
									</div>
									<div class="qty">
										<p><?php esc_html_e('Qty: ', 'wp-commerce'); ?> <span><?php echo esc_html( $qty ); ?></span></p>
									</div>
								</div>
								<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><span class="fa fa-times-circle"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key )  ), __( 'Remove this item', 'wp-commerce' ) ), $cart_item_key ); ?>
							</div>
						<?php endforeach;?>

						<div class="subtotal">
							<div class="text">
								<?php esc_html_e( 'Subtotal', 'wp-commerce' ); ?>
							</div>
							<div class="total-num">
								<?php echo WC()->cart->get_cart_subtotal(); ?>
							</div>
						</div>
						<div class="cart-checkout">
							<a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'cart' ) )); ?>" class="btn view-btn"><?php esc_html_e('View Cart','wp-commerce');?></a>
							<a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'checkout' ) )); ?>" class="btn checkout-btn"><?php esc_html_e('Checkout','wp-commerce');?></a>
						</div>
					</div>
					<?php else:?>
						<div class="mini-cart-media"><?php esc_attr_e( 'No products in the cart.', 'wp-commerce' ); ?></div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
	<?php
}