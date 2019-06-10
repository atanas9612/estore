<?php
/**
 * AT: Products Slider
 *
 * Widget show the woocommerce products.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

class ghumti_product extends WP_Widget {
/**
* Register Widget with Wordpress
* 
*/
public function __construct() {
  $widget_ops = array( 
    'classname' => 'ghumti_product',
    'description' => __( 'Slider with woocommerce products.', 'ghumti' )
  );
  parent::__construct( 'ghumti_product', __( 'AT: Product Slider', 'ghumti' ), $widget_ops );
}

/**
* Helper function that holds widget fields
* Array is used in update and form functions
*/
private function widget_fields() {

  $prod_type = array(
    'latest_product' => __('Latest Product', 'ghumti'),
    'category' => __('Category', 'ghumti'),
    'upsell_product' => __('UpSell Product', 'ghumti'),
    'feature_product' => __('Feature Product', 'ghumti'),
    'on_sale' => __('On Sale Product', 'ghumti'),
  );

  $fields = array(
    'product_title' => array(
      'ghumti_widgets_name' => 'product_title',
      'ghumti_widgets_title' => __('Title', 'ghumti'),
      'ghumti_widgets_field_type' => 'text',

    ),
    'product_type' => array(
      'ghumti_widgets_name' => 'product_type',
      'ghumti_widgets_title' => __('Select Product Type', 'ghumti'),
      'ghumti_widgets_field_type' => 'select',
      'ghumti_widgets_field_options' => $prod_type,
      'ghumti_widgets_field_class' => 'ghumti-type-wrap',
    ),
    'product_category' => array(
      'ghumti_widgets_name' => 'product_category',
      'ghumti_widgets_title' => __('Select Product Category', 'ghumti'),
      'ghumti_widgets_field_type' => 'select',
      'ghumti_widgets_field_options' => ghumti_woocommerce_categories_lists(),
      'ghumti_widgets_field_class' => 'ghumti-type-select',
    ),
    'product_number' => array(
      'ghumti_widgets_name' => 'product_number',
      'ghumti_widgets_title' => __('Select the number of Product to show', 'ghumti'),
      'ghumti_widgets_default'      => '2',
      'ghumti_widgets_field_type' => 'number',
    ),
    // 'product_size_type' => array(
    //   'ghumti_widgets_name' => 'product_size_type',
    //   'ghumti_widgets_title' => __('Product Slider Type', 'ghumti'),
    //   'ghumti_widgets_field_type' => 'select',
    //   'ghumti_widgets_field_options' => array('full-width'=>__('Full Width','ghumti'),
    //     'half-width'=>__('With Sidebar Form on Right','ghumti'),                                                    
    //   )
    // ),
  );
  return $fields;
}

public function widget($args, $instance){
  extract($args);

  if(!empty($instance)):
    $product_title = empty( $instance['product_title'] ) ? '' : $instance['product_title'];
    $product_size_type = empty( $instance['product_size_type'] ) ? 'full-width' : $instance['product_size_type'];
    $product_type = empty( $instance['product_type'] ) ? 'latest_product' : $instance['product_type'];
    $product_category = empty( $instance['product_category'] ) ? '' : $instance['product_category'];
    $product_number = empty( $instance['product_number'] ) ? '2' : $instance['product_number'];

    $product_args       =   '';
    if($product_type == 'category'){
      $product_args = array(
        'post_type' => 'product',
        'tax_query' => array(array('taxonomy'  => 'product_cat',
          'field'     => 'id', 
          'terms'     => $product_category                                                                 
        )),
        'posts_per_page' => $product_number
      );
    }
    elseif($product_type == 'latest_product'){
      $product_args = array(
        'post_type' => 'product',
        'posts_per_page' => $product_number
      );
    }
    elseif($product_type == 'upsell_product'){
      $product_args = array(
        'post_type'         => 'product',
        'meta_key'          => 'total_sales',
        'orderby'           => 'meta_value_num',
        'posts_per_page'    => $product_number
      );
    }
    elseif($product_type == 'feature_product'){

      $product_visibility_term_ids = wc_get_product_visibility_term_ids();
      $product_args = array(  
       'post_type' => 'product',  
       'posts_per_page' => $product_number,
       'meta_query'     => array(),
       'tax_query'      => array(
         'relation' => 'AND',
       ),
     ); 
      $product_args['tax_query'][] = array(
        'taxonomy' => 'product_visibility',
        'field'    => 'term_taxonomy_id',
        'terms'    => $product_visibility_term_ids['featured'],
      );
    }
    elseif($product_type == 'on_sale'){
      $product_args = array(
        'post_type'      => 'product',
        'meta_query'     => array(
          'relation' => 'OR',
          array(
            // Simple products type
            'key'           => '_sale_price',
            'value'         => 0,
            'compare'       => '>',
            'type'          => 'numeric'
          ),
          array(
            // Variable products type
            'key'           => '_min_variation_sale_price',
            'value'         => 0,
            'compare'       => '>',
            'type'          => 'numeric'
          )
        )
      );
    }

    ?>
    <?php echo wp_kses_post($before_widget); ?>
    <div class="product-wrapper">
      <?php 
      if( !empty( $product_title ) ) {
        echo wp_kses_post($before_title) . esc_html( $product_title ) . wp_kses_post($after_title);
      }
      ?>
      <div class="<?php echo 'prod-slider-'.esc_attr($product_size_type);?> clear">
        <div class="slider-<?php echo esc_attr($product_size_type);?>">
          <ul class="owl-carousel ghumti-product-slider">
            <?php
            $count=0;
            $product_loop = new WP_Query( $product_args );
            if ( $product_loop->have_posts() ) {
              while ( $product_loop->have_posts() ) {
                $product_loop->the_post(); 
                wc_get_template_part( 'content', 'product' );
              }
              wp_reset_postdata();
            }
            ?>
          </ul>
        </div>
        <?php
        // if($product_size_type=='half-width'){
        //   echo do_shortcode(get_theme_mod('ghumti_form_shortcode'));
        // }
        ?>
      </div>
    </div>
    <?php echo wp_kses_post($after_widget);?>
    <?php
  endif;
}

/**
* Sanitize widget form values as they are saved.
*
* @see WP_Widget::update()
*
* @param	array	$new_instance	Values just sent to be saved.
* @param	array	$old_instance	Previously saved values from database.
*
* @uses	ghumti_widgets_updated_field_value()		defined in widget-fields.php
*
* @return	array Updated safe values to be saved.
*/
public function update($new_instance, $old_instance) {
  $instance = $old_instance;

  $widget_fields = $this->widget_fields();
  foreach ($widget_fields as $widget_field) {
    extract($widget_field);
    $instance[$ghumti_widgets_name] = ghumti_widgets_updated_field_value($widget_field, $new_instance[$ghumti_widgets_name]);
  }

  return $instance;
}

/**
* Back-end widget form.
*
* @see WP_Widget::form()
*
* @param	array $instance Previously saved values from database.
*
* @uses	ghumti_widgets_show_widget_field()		defined in widget-fields.php
*/
public function form($instance) {
  $widget_fields = $this->widget_fields();
  foreach ($widget_fields as $widget_field) {
    extract($widget_field);
    $ghumti_widgets_field_value = !empty($instance[$ghumti_widgets_name]) ? esc_attr($instance[$ghumti_widgets_name]) : '';
    ghumti_widgets_show_widget_field($this, $widget_field, $ghumti_widgets_field_value);
  }
}
}