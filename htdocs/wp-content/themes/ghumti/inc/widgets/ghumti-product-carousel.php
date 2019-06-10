<?php
/**
 * AT: Carousel
 *
 * Widget show the posts from selected categories in carousel layouts.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

class ghumti_product_Carousel extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'ghumti_product_carousel',
            'description' => __( 'Displays products from selected categories in carousel.', 'ghumti' )
        );
        parent::__construct( 'ghumti_product_carousel', __( 'AT: Product Carousel', 'ghumti' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $ghumti_woocommerce_categories_lists = ghumti_woocommerce_categories_lists();
        
        $fields = array(

            'product_title' => array(
                'ghumti_widgets_name'         => 'product_title',
                'ghumti_widgets_title'        => __( 'Widget title', 'ghumti' ),
                'ghumti_widgets_description'  => __( 'Enter your product title. (Optional - Leave blank to hide title.)', 'ghumti' ),
                'ghumti_widgets_field_type'   => 'text'
            ),

            'product_cat_slugs' => array(
                'ghumti_widgets_name'         => 'product_cat_slugs',
                'ghumti_widgets_title'        => __( 'Product Categories', 'ghumti' ),
                'ghumti_widgets_field_type'   => 'select',
                'ghumti_widgets_field_options' => $ghumti_woocommerce_categories_lists
            )
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

        $cat_product_title      = empty( $instance['product_title'] ) ? '' : $instance['product_title'];
        $ghumti_product_cat  = empty( $instance['product_cat_slugs'] ) ? '' : $instance['product_cat_slugs'];
        $ghumti_product_layout     = 'layout1';

        if(!empty($ghumti_product_cat)) {
            echo wp_kses_post($before_widget);
            ?>
            <div class="cat-product-wrap clearfix">
              <?php 
              if( !empty( $cat_product_title ) ) {
                echo wp_kses_post($before_title) . esc_html( $cat_product_title ) . wp_kses_post($after_title);
            }
            ?>
            <div class="ghumti-product-carousel-wrap">
                <ul class="ghumti-product-carousel owl-carousel">
                    <?php 
                    $prod_args = array(
                        'post_type' => 'product',
                        'tax_query' => array(array('taxonomy'  => 'product_cat',
                            'field'     => 'id', 
                            'terms'     => $ghumti_product_cat                                                                 
                        )),
                        'posts_per_page' => '4'
                    );
                    $product_query = new WP_Query($prod_args);
                    if($product_query->have_posts()){
                        while($product_query->have_posts()){
                            $product_query->the_post();
                            wc_get_template_part( 'content', 'productcarousel' );
                        }
                        wp_reset_postdata();
                    }
                    ?>
                </ul>
            </div>
            <?php 
        }?>
        <?php
        echo wp_kses_post($after_widget);
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    ghumti_widgets_updated_field_value()     defined in ghumti-widget-fields.php
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
            $instance[$ghumti_widgets_name] = ghumti_widgets_updated_field_value( $widget_field, $new_instance[$ghumti_widgets_name] );
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
     * @uses    ghumti_widgets_show_widget_field()       defined in ghumti-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $ghumti_widgets_field_value = !empty( $instance[$ghumti_widgets_name] ) ? wp_kses_post( $instance[$ghumti_widgets_name] ) : '';
            ghumti_widgets_show_widget_field( $this, $widget_field, $ghumti_widgets_field_value );
        }
    }
}