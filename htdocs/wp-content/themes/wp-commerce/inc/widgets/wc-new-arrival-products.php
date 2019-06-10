<?php
/**
 * Widget for display New Arrivals products.
 *
 * @package WP Commerce
 * @since 1.0.0
 */

class WP_Commerce_New_Arrival_Products extends WP_Widget {
/**
     * Register widget with WordPress.
     */
public function __construct() {
    $widget_ops = array( 
        'classname'                     => 'wp_commerce_new_arrival_products',
        'description'                   => __( 'Display numbers of New Arrival products from selective categories.', 'wp-commerce' ),
        'customize_selective_refresh'   => true,
    );
    parent::__construct( 'wp_commerce_new_arrival_products', __( 'WP Commerce: New Arrival Products', 'wp-commerce' ), $widget_ops );
}

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $fields = array(
            'section_post_count' => array(
                'wp_commerce_widgets_name'         => 'section_post_count',
                'wp_commerce_widgets_title'        => __( 'Product Count', 'wp-commerce' ),
                'wp_commerce_widgets_default'      => 10,  
                'wp_commerce_widgets_field_type'   => 'number'
            ),
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $wp_commerce_product_count  = empty( $instance['section_post_count'] ) ? 10 : $instance['section_post_count'];

        $new_arrival_args = array(
            'post_type' => 'product',
            'posts_per_page' => absint( $wp_commerce_product_count ),
            'stock' => 1,
            'orderby' =>'date',
            'order' => 'DESC' 
        );        
        $new_arrival_query = new WP_Query( $new_arrival_args );
        $total_post = $new_arrival_query->post_count;
        ?>     
        <?php
        if ( $new_arrival_query->have_posts() ) {
            while ( $new_arrival_query->have_posts() ) {
                $new_arrival_query->the_post();?>
                <div class="col-md-3 col-holder">
                    <div class="product">
                      <div class="card">
                        <a href="#" class="img-holder">
                          <?php the_post_thumbnail( 'wp-commerce-product-thumbs-168-*-168' );?>
                      </a>
                      <div class="card-body">
                          <ul class="option">
                            <li>
                                <?php global $product;?>
                                <a href="<?php echo esc_url( $product->add_to_cart_url() );?>" class="active" title="Add to cart"><span class="fa fa-shopping-cart"></span></a>
                            </li>
                            <li>
                              <a href="<?php esc_url(the_permalink());?>" title="View"><span class="fa fa-eye"></span></a>
                          </li>
                      </ul>
                      <a href="<?php esc_url(the_permalink());?>"><h6><?php the_title();?></h6></a>
                      <?php $terms =  get_the_terms( $product->get_id(), 'product_cat' );
                      if ( $terms && ! is_wp_error( $terms ) ) {?>
                         <span class="category"><?php echo esc_html($terms[0]->name);?></span>
                     <?php }?>
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
                 </div>
             </div>
         </div>
     </div>
 <?php  }

} else {?>
    <div class="wp-commerce-no-product-found"><?php esc_html_e( 'No New Arrival products found', 'wp-commerce' ); ?></div>
<?php }
wp_reset_postdata();
?>
<?php
}

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    wp_commerce_widgets_updated_field_value()      defined in es-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$wp_commerce_widgets_name] = wp_commerce_widgets_updated_field_value( $widget_field, $new_instance[$wp_commerce_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    wp_commerce_widgets_show_widget_field()        defined in es-widget-fields.php
     */
    public function form( $instance ) {

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );

            if ( empty( $instance ) && isset( $wp_commerce_widgets_default ) ) {
                $wp_commerce_widgets_field_value = $wp_commerce_widgets_default;
            } elseif( empty( $instance ) ) {
                $wp_commerce_widgets_field_value = '';
            } else {
                $wp_commerce_widgets_field_value = wp_kses_post( $instance[$wp_commerce_widgets_name] );
            }
            //$wp_commerce_widgets_field_value = !empty( $instance[$wp_commerce_widgets_name] ) ? wp_kses_post( $instance[$wp_commerce_widgets_name] ) : '';
            wp_commerce_widgets_show_widget_field( $this, $widget_field, $wp_commerce_widgets_field_value );
        }
    }
}