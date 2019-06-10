<?php
/**
 * AT: Cta With Form
 *
 * Widget show the call to action with shortcode inserted.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

class ghumti_cta_form extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'ghumti_cta_form',
            'description' => __( 'A widget that shows Call to Action with Form.', 'ghumti' )
        );
        parent::__construct( 'ghumti_cta_form', __( 'AT: Call to Action with Form', 'ghumti' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'cta_form_title' => array(
                'ghumti_widgets_name' => 'cta_form_title',
                'ghumti_widgets_title' => __('Title', 'ghumti'),
                'ghumti_widgets_field_type' => 'text',
            ),
            'cta_form_desc' => array(
                'ghumti_widgets_name' => 'cta_form_desc',
                'ghumti_widgets_title' => __('Description', 'ghumti'),
                'ghumti_widgets_field_type' => 'textarea',
            ),
            'cta_form_sc' => array(
                'ghumti_widgets_name' => 'cta_form_sc',
                'ghumti_widgets_title' => __('Contact Form Shortcode', 'ghumti'),
                'ghumti_widgets_field_type' => 'textarea',
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
    public function widget($args, $instance) {
        extract($args);
        if(!empty($instance)):
            $cta_form_title = empty( $instance['cta_form_title'] ) ? '' : $instance['cta_form_title'];
            $cta_form_desc = empty( $instance['cta_form_desc'] ) ? '' : $instance['cta_form_desc'];
            $cta_form_sc = empty( $instance['cta_form_sc'] ) ? '' : $instance['cta_form_sc'];
            echo wp_kses_post($before_widget); ?>
            <div class="cta-form-wrap clearfix">
                <?php 
                if( !empty( $cta_form_title ) ) {
                    echo wp_kses_post($before_title) . esc_html( $cta_form_title ) . wp_kses_post($after_title);
                }
                ?>
                <div class="cta-wrap-form-content">
                    <?php if(!empty($cta_form_desc)){ ?>
                    <div class="cta-content-wrap">
                        <div class="cta-desc wow fadeInUp" data-wow-delay="0.8s">
                            <?php echo wp_kses_post($cta_form_desc); ?>
                        </div>
                    </div>
                    <?php }?>
                    <?php if(!empty($cta_form_sc)){ ?>
                    <div class="cta-form wow fadeInUp" data-wow-delay="1s"><?php echo do_shortcode($cta_form_sc) ; ?></div>
                    <?php }?>
                </div>
            </div> 
            <?php 
            echo wp_kses_post($after_widget);
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
     * @param	array $instance Previously saved values from database.
     *
     * @uses	ghumti_widgets_show_widget_field()		defined in widget-fields.php
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