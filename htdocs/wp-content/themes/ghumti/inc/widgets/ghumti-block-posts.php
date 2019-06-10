<?php
/**
 * AT: Block Posts
 *
 * Widget show the block posts from selected category in different layouts.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

class ghumti_Block_Posts extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'ghumti_block_posts ghumti-clearfix',
            'description' => __( 'Displays block posts from selected category in different layouts.', 'ghumti' )
        );
        parent::__construct( 'ghumti_block_posts', __( 'AT: Block Posts', 'ghumti' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $fields = array(

            'block_title' => array(
                'ghumti_widgets_name'         => 'block_title',
                'ghumti_widgets_title'        => __( 'Block title', 'ghumti' ),
                'ghumti_widgets_description'  => __( 'Enter your block title. (Optional - Leave blank to hide title.)', 'ghumti' ),
                'ghumti_widgets_field_type'   => 'text'
            ),

            'block_cat_slug' => array(
                'ghumti_widgets_name'         => 'block_cat_slug',
                'ghumti_widgets_title'        => __( 'Block Category', 'ghumti' ),
                'ghumti_widgets_default'      => '',
                'ghumti_widgets_field_type'   => 'category_dropdown'
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

        $ghumti_block_title    = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $ghumti_block_cat_slug = empty( $instance['block_cat_slug'] ) ? '' : $instance['block_cat_slug'];
        $ghumti_block_layout   = 'layout1';

        echo wp_kses_post($before_widget);
        ?>
        <div class="ghumti-block-wrapper block-posts ghumti-clearfix <?php echo esc_attr( $ghumti_block_layout ); ?>">
            <?php 
            if( !empty( $ghumti_block_title ) ) {
                echo wp_kses_post($before_title) . esc_html( $ghumti_block_title ) . wp_kses_post($after_title);
            }
            ?>
            <div class="ghumti-block-posts-wrapper ghumti-clearfix">
            	<?php
                ghumti_block_default_layout_section( $ghumti_block_cat_slug );
                ?>
            </div><!-- .ghumti-block-posts-wrapper -->
        </div><!--- .ghumti-block-wrapper -->
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