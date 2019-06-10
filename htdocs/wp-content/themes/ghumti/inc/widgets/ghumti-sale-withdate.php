<?php
/**
 * AT: OnSale Products
 *
 * Widget show the woocommerce products.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */
class ghumti_special_product extends WP_Widget {
    /**
     * Register Widget with Wordpress
     * 
     */
    public function __construct() {
    	$widget_ops = array( 
    		'classname' => 'ghumti_special_product',
    		'description' => __( 'Display Special Offer Product with date.', 'ghumti' )
    	);
    	parent::__construct( 'ghumti_special_product', __( 'AT: OnSale Product', 'ghumti' ), $widget_ops );
    }

    private function widget_fields() {      
     $ghumti_woocommerce_categories_lists = ghumti_woocommerce_categories_lists();

     $fields = array(
       'product_title' => array(
        'ghumti_widgets_name' => 'product_title',
        'ghumti_widgets_title' => __('Title', 'ghumti'),
        'ghumti_widgets_field_type' => 'text',
      ),
       'special_multicheckboxed_category' => array(
        'ghumti_widgets_name' => 'special_multicheckboxed_category',
        'ghumti_widgets_title' => __('Select Category For Special Deals', 'ghumti'),
        'ghumti_widgets_field_type' => 'multicheckboxes',
        'ghumti_widgets_field_options' => $ghumti_woocommerce_categories_lists
      ),         
       'product_number' => array(
        'ghumti_widgets_name' => 'product_number',
        'ghumti_widgets_title' => __('Display the Number of Deals Product show', 'ghumti'),
        'ghumti_widgets_default' => '1',
        'ghumti_widgets_field_type' => 'number',
      ));
     return $fields;
   }
   public function widget($args, $instance){
     extract($args);
     $product_title = empty( $instance['product_title'] ) ? '' : $instance['product_title'];
     $product_number = empty( $instance['product_number'] ) ? '1' : $instance['product_number'];
     $deals_categroy = array();
     if(!empty($instance['special_multicheckboxed_category'])){
      foreach ($instance['special_multicheckboxed_category'] as $key => $special_category){
        $deals_categroy[] = $key;
      }
    }

    $product_args = array(
      'post_type' => 'product',
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
     ),
      'tax_query' => array(
       array(
        'taxonomy'  => 'product_cat',
        'field'     => 'term_id', 
        'terms'     => $deals_categroy
      ),
     ),      
      'posts_per_page' => $product_number
    );
    ?>
    <?php echo wp_kses_post($before_widget); ?>
    <div class="ghumti-special-product">      
      <?php 
      if( !empty( $product_title ) ) {
       echo wp_kses_post($before_title) . esc_html( $product_title ) . wp_kses_post($after_title);
     }
     ?>
     <ul class="ghumti-sale-slide owl-carousel">
       <?php
       $count = 0;
       $product_loop = new WP_Query( $product_args );
       if( $product_loop->have_posts() ) {
         while ( $product_loop->have_posts() ) {
          $product_loop->the_post();
          $productcount = $product_loop->found_posts;
          global $product;
          ?>
          <li>
            <a class="item-img" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> 
             <?php
             do_action( 'woocommerce_before_shop_loop_item_title' );
             ?>
           </a>
           <div class="item-content-wrap">
            <h3>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">  
                <?php the_title(); ?>
              </a>
            </h3>
            <div class="short_desc"><?php echo esc_html(get_the_excerpt()); ?></div>
            <span class="price">
             <?php echo wp_kses_post($product->get_price_html()); ?>
           </span>
           <?php 
           woocommerce_template_loop_add_to_cart( $product_loop->post, $product );

           $product_id = get_the_ID();
           $sale_price_dates_to    = ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
          //$price_sale = get_post_meta( $product_id, '_sale_price', true );
           $price_sale  = $product->get_sale_price();    
           $date=date_create($sale_price_dates_to);
           
           $date_formt = get_option('date_format');
           $time_formt = get_option('time_format');
           $default_format = $date_formt.' '.$time_formt;
           $new_date = date_format($date,$default_format);

           if(!empty($sale_price_dates_to)) : 
            if(!empty($price_sale)) :
              ?>
              <div class="fl-pcountdown-cnt" style="color:red;">          
               <span class="countdown_title"><?php esc_html_e('This limited offer ends in:','ghumti');?></span>
               <ul class="fl-style1 fl-medium fl-countdown fl-countdown-pub countdown_<?php echo esc_attr($product_id); ?>">
                <li><span class="days">00</span><p class="days_text"><?php esc_html_e('Days','ghumti');?></p></li>
                <li><span class="hours">00</span><p class="hours_text"><?php esc_html_e('Hours','ghumti');?></p></li>
                <li><span class="minutes">00</span><p class="minutes_text"><?php esc_html_e('Minutes','ghumti');?></p></li>
                <li><span class="seconds">00</span><p class="seconds_text"><?php esc_html_e('Seconds','ghumti');?></p></li>
              </ul>
            </div>
            <script type="text/javascript">
             jQuery(document).ready(function($) {
              jQuery(".countdown_<?php echo esc_attr($product_id); ?>").countdown({
               date: "<?php echo esc_attr($new_date); ?>",
               offset: -8,
               day: "<?php esc_html_e('Day','ghumti');?>",
               days: "<?php esc_html_e('Days','ghumti');?>"
             }, function () {
             });
            });
          </script>
        <?php endif; endif; ?>        
      </div>         
    </li>
    <?php 
  }
  wp_reset_postdata();
}
?>
</ul>
</div>
<?php echo wp_kses_post($after_widget); ?>
<?php
}

public function update($new_instance, $old_instance) {
 $instance = $old_instance;
 $widget_fields = $this->widget_fields();
 foreach ($widget_fields as $widget_field) {
  extract($widget_field);
  $instance[$ghumti_widgets_name] = ghumti_widgets_updated_field_value($widget_field, $new_instance[$ghumti_widgets_name]);
}
return $instance;
}

public function form($instance) {
 $widget_fields = $this->widget_fields();
 foreach ($widget_fields as $widget_field) {
  extract($widget_field);
  $ghumti_widgets_field_value = !empty($instance[$ghumti_widgets_name]) ? $instance[$ghumti_widgets_name] : '';
  ghumti_widgets_show_widget_field($this, $widget_field, $ghumti_widgets_field_value);
}
}
}