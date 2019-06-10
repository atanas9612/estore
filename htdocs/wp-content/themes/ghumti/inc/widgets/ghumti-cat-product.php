<?php
/**
 * AT: Category & Product
 *
 * Widget show the woocommerce category and products of it.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

class ghumti_cat_product extends WP_Widget {
  /**
  * Register Widget with Wordpress
  * 
  */
  public function __construct() {

    $widget_ops = array( 
      'classname' => 'ghumti_cat_product',
      'description' => __( 'This widgets show the Category Image,Description and Product of that Category.', 'ghumti' )
    );
    parent::__construct( 'ghumti_cat_product', __( 'AT: Category & Product', 'ghumti' ), $widget_ops );
  }

  /**
  * Helper function that holds widget fields
  * Array is used in update and form functions
  */
  private function widget_fields() {

    $prod_type = array(
      'right_align' => __('Right Align With Category Image', 'ghumti'),
      'left_align' => __('Left Align With Category Image', 'ghumti'),
    );
    

    $fields = array(
      'cat_product_title' => array(
        'ghumti_widgets_name' => 'cat_product_title',
        'ghumti_widgets_title' => __('Title', 'ghumti'),
        'ghumti_widgets_field_type' => 'text',
      ),
      'cat_product_alignment' => array(
        'ghumti_widgets_name' => 'cat_product_alignment',
        'ghumti_widgets_title' => __('Select the Display Style (Image Alignment)', 'ghumti'),
        'ghumti_widgets_field_type' => 'select',
        'ghumti_widgets_field_options' => $prod_type

      ),
      'cat_product_category' => array(
        'ghumti_widgets_name' => 'cat_product_category',
        'ghumti_widgets_title' => __('Select Product Category', 'ghumti'),
        'ghumti_widgets_field_type' => 'select',
        'ghumti_widgets_field_options' => ghumti_woocommerce_categories_lists()

      ),


    );
    return $fields;
  }

  public function widget($args, $instance){
    extract($args);
    if(!empty($instance)):
      $cat_product_title = empty( $instance['cat_product_title'] ) ? '' : $instance['cat_product_title'];
      $cat_product_alignment = empty( $instance['cat_product_alignment'] ) ? '' : $instance['cat_product_alignment'];
      $cat_product_category  = empty( $instance['cat_product_category'] ) ? '' : $instance['cat_product_category'];
      if(!empty($cat_product_category)):
        ?>
        <?php echo wp_kses_post($before_widget); ?>
        <div class="cat-product-wrap clearfix">
          <?php 
          if( !empty( $cat_product_title ) ) {
            echo wp_kses_post($before_title) . esc_html( $cat_product_title ) . wp_kses_post($after_title);
          }
          ?>
          <div class="<?php echo 'cat_'.esc_attr($cat_product_alignment);?>">
            <div class="feature-cat-product-wrap">
              <?php 
              $woo_cat_id_int = (int)$cat_product_category;
              $terms_link = get_term_link($woo_cat_id_int,'product_cat');
              if(!is_wp_error($terms_link)){
              ?>
              <div class="feature-cat-image">
                <a href="<?php echo esc_url( $terms_link ); ?>">
                  <?php 
                  $thumbnail_id = get_woocommerce_term_meta($cat_product_category, 'thumbnail_id', true);
                  if (!empty($thumbnail_id)) {
                    $image = wp_get_attachment_image_src($thumbnail_id, 'ghumti-cat-square');
                    echo '<img src="' . esc_url($image[0]) . '" alt=""  />';
                  }
                  else{ 
                    ?>
                    <img src="<?php echo get_template_directory_uri().'/assets/images/img388x388.png';?>" alt="<?php esc_html_e('No Image','ghumti')?>"/>
                    <?php 
                  } ?>
                </a>
                <div class="product-cat-desc">
                  <?php 
                  $taxonomy = 'product_cat';
                  $terms = term_description( $cat_product_category, $taxonomy );
                  $terms_name = get_term( $cat_product_category, $taxonomy );
                  ?>
                  <h3>
                    <a href="<?php echo esc_url( $terms_link ); ?>">
                      <?php echo esc_html($terms_name->name); ?>
                    </a>
                  </h3>
                  <div class="cat_desc">  
                    <?php echo wp_kses_post($terms); ?>   
                  </div>  
                </div>
              </div>
              <ul class="ghumti-catproduct owl-carousel">
                <?php 
                $prod_args = array(
                  'post_type' => 'product',
                  'tax_query' => array(array('taxonomy'  => 'product_cat',
                    'field'     => 'id', 
                    'terms'     => $cat_product_category                                                                 
                  )),
                  'posts_per_page' => '6'
                );
                $product_query = new WP_Query($prod_args);
                if($product_query->have_posts()){
                  while($product_query->have_posts()){
                    $product_query->the_post();?>
                    <?php wc_get_template_part( 'content', 'product' ); ?>
                    <?php
                  }
                  wp_reset_postdata();
                }
                ?>
              </ul>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <?php echo wp_kses_post($after_widget); ?>
        <?php
      endif;
    endif;
  }

    /**
    * Sanitize widget form values as they are saved.
    *
    * @see WP_Widget::update()
    *
    * @param  array $new_instance Values just sent to be saved.
    * @param  array $old_instance Previously saved values from database.
    *
    * @uses ghumti_widgets_updated_field_value()    defined in widget-fields.php
    *
    * @return array Updated safe values to be saved.
    */
    public function update($new_instance, $old_instance) {
      $instance = $old_instance;

      $widget_fields = $this->widget_fields();

      // Loop through fields
      foreach ($widget_fields as $widget_field) {

        extract($widget_field);

        // Use helper function to get updated field values
        $instance[$ghumti_widgets_name] = ghumti_widgets_updated_field_value($widget_field, $new_instance[$ghumti_widgets_name]);
      }

      return $instance;
    }

    /**
    * Back-end widget form.
    *
    * @see WP_Widget::form()
    *
    * @param  array $instance Previously saved values from database.
    *
    * @uses ghumti_widgets_show_widget_field()    defined in widget-fields.php
    */
    public function form($instance) {
      $widget_fields = $this->widget_fields();

      // Loop through fields
      foreach ($widget_fields as $widget_field) {

        // Make array elements available as variables
        extract($widget_field);
        $ghumti_widgets_field_value = !empty($instance[$ghumti_widgets_name]) ? esc_attr($instance[$ghumti_widgets_name]) : '';
        ghumti_widgets_show_widget_field($this, $widget_field, $ghumti_widgets_field_value);
      }
    }
  }