<?php
/**
 * AT: Featured Slider
 *
 * Widget to display posts from selected categories in featured slider ( slider + featured section )
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

class ghumti_Featured_Slider extends WP_widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'ghumti_featured_slider',
            'description' => __( 'Displays posts from selected categories in slider with featured section.', 'ghumti' )
        );
        parent::__construct( 'ghumti_featured_slider', __( 'AT: Banner Posts Slider', 'ghumti' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $ghumti_categories_lists = ghumti_categories_lists();

        $fields = array(
            'slider_cat_slugs' => array(
                'ghumti_widgets_name'         => 'slider_cat_slugs',
                'ghumti_widgets_title'        => __( 'Slider Categories', 'ghumti' ),
                'ghumti_widgets_field_type'   => 'multicheckboxes',
                'ghumti_widgets_field_options' => $ghumti_categories_lists
            ),
            'caption_layout' => array(
                'ghumti_widgets_name'         => 'caption_layout',
                'ghumti_widgets_title'        => __( 'Caption Layouts', 'ghumti' ),
                'ghumti_widgets_default'      => 'left-align-caption',
                'ghumti_widgets_field_type'   => 'selector',
                'ghumti_widgets_field_options' => array(
                    'no-caption' => esc_url( get_template_directory_uri() . '/assets/images/no-caption.png' ),
                    'left-align-caption' => esc_url( get_template_directory_uri() . '/assets/images/left-caption.png' ),
                    'right-align-caption' => esc_url( get_template_directory_uri() . '/assets/images/right-caption.png' ),
                    'center-align-caption' => esc_url( get_template_directory_uri() . '/assets/images/center-caption.png' ),
                )
            ),
            'featured_cat_slugs' => array(
                'ghumti_widgets_name'         => 'featured_cat_slugs',
                'ghumti_widgets_title'        => __( 'Featured Post Categories', 'ghumti' ),
                'ghumti_widgets_field_type'   => 'multicheckboxes',
                'ghumti_widgets_field_options' => $ghumti_categories_lists
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

        $ghumti_slider_cat_slugs    = empty( $instance['slider_cat_slugs'] ) ? '' : $instance['slider_cat_slugs'];
        $ghumti_caption_layout     = empty( $instance['caption_layout'] ) ? 'left-align-caption' : $instance['caption_layout'];
        $ghumti_featured_cat_slugs  = empty( $instance['featured_cat_slugs'] ) ? '' : $instance['featured_cat_slugs'];

        echo wp_kses_post($before_widget);
        $ghumti_class = ' ghumti-empty';
        if( !empty( $ghumti_slider_cat_slugs )  && !empty( $ghumti_featured_cat_slugs ) ) {
            $ghumti_class = ' ghumti-slider-featured';
        }
        elseif( !empty( $ghumti_slider_cat_slugs ) ) {
            $ghumti_class = ' ghumti-slider-single';
        }
        elseif( !empty( $ghumti_featured_cat_slugs ) ) {
            $ghumti_class = ' ghumti-featured-single';
        }
        ?>
        <div class="ghumti-block-wrapper ghumti-clearfix <?php echo esc_attr( $ghumti_caption_layout.$ghumti_class); ?>">
            <div class="slider-posts">
                <?php
                if( !empty( $ghumti_slider_cat_slugs ) ) {
                    $checked_cats = array();
                    foreach( $ghumti_slider_cat_slugs as $cat_key => $cat_value ){
                        $checked_cats[] = $cat_key;
                    }
                    $get_checked_cat_slugs = implode( ",", $checked_cats );
                    $ghumti_post_count = apply_filters( 'ghumti_slider_posts_count', 4 );
                    $ghumti_slider_args = array(
                        'post_type'      => 'post',
                        'category_name'  => wp_kses_post( $get_checked_cat_slugs ),
                        'posts_per_page' => absint( $ghumti_post_count ),
                        'orderby'        => 'rand'
                    );
                    $ghumti_slider_query = new WP_Query( $ghumti_slider_args );
                    if( $ghumti_slider_query->have_posts() ) {
                        echo '<ul class="owl-carousel ghumti-main-slider">';
                        while( $ghumti_slider_query->have_posts() ) {
                            $ghumti_slider_query->the_post();
                            if( has_post_thumbnail() ) {
                                ?>
                                <li>
                                    <div class="ghumti-single-slide-wrap">
                                        <div class="ghumti-slide-thumb">
                                            <?php
                                            if(' ghumti-slider-single' == $ghumti_class){
                                                the_post_thumbnail( 'ghumti-slider' );
                                            }else{
                                                the_post_thumbnail( 'ghumti-slider-half' );
                                            } ?>
                                        </div><!-- .ghumti-slide-thumb -->
                                        <?php if($ghumti_caption_layout!='no-caption'){ ?>
                                            <div class="ghumti-slide-content-wrap">
                                                <h3 class="post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                <div class="ghumti-excerpt">
                                                    <?php the_excerpt();?>
                                                    <a class="ghumti-read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','ghumti');?></a>
                                                </div>
                                            </div> <!-- ghumti-slide-content-wrap -->
                                        <?php } ?>
                                    </div><!-- .single-slide-wrap -->
                                </li>
                                <?php
                            }
                        }
                        echo '</ul>';
                        wp_reset_postdata();
                    }
                }
                ?>
            </div><!-- .slider-posts -->
            <?php
            if( !empty( $ghumti_featured_cat_slugs ) ) {
                ?>
                <div class="featured-posts">
                    <div class="featured-posts-wrapper">
                        <?php
                        $checked_cats = array();
                        foreach( $ghumti_featured_cat_slugs as $cat_key => $cat_value ){
                            $checked_cats[] = $cat_key;
                        }
                        $get_checked_cat_slugs = implode( ",", $checked_cats );
                        $ghumti_post_count = apply_filters( 'ghumti_slider_featured_posts_count', 2 );
                        $ghumti_slider_args = array(
                            'post_type'      => 'post',
                            'category_name'  => wp_kses_post( $get_checked_cat_slugs ),
                            'posts_per_page' => absint( $ghumti_post_count ),                            
                            'orderby'        => 'rand'
                        );
                        $ghumti_slider_query = new WP_Query( $ghumti_slider_args );
                        if( $ghumti_slider_query->have_posts() ) {
                            while( $ghumti_slider_query->have_posts() ) {
                                $ghumti_slider_query->the_post();
                                ?>
                                <div class="ghumti-single-post-wrap ghumti-clearfix">
                                    <div class="ghumti-single-post">
                                        <div class="ghumti-post-thumb">
                                            <?php
                                            if( has_post_thumbnail() ) {
                                                the_post_thumbnail( 'ghumti-featured-medium' );
                                            }
                                            ?>
                                        </div><!-- .ghumti-post-thumb -->
                                        <div class="ghumti-post-content">
                                            <h3 class="ghumti-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <a class="ghumti-read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','ghumti');?></a>
                                        </div><!-- .ghumti-post-content -->
                                    </div> <!-- ghumti-single-post -->
                                </div><!-- .ghumti-single-post-wrap -->

                                <?php
                            }
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                </div><!-- .featured-posts -->
                <?php
            }
            ?>
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