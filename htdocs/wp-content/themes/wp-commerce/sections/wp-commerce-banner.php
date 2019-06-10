 <?php $wp_commerce_frontpage_slider_option = get_theme_mod( 'wp_commerce_frontpage_slider_option', 'show' );
 if( $wp_commerce_frontpage_slider_option == 'show' ) :?>
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ml-auto">
                    <div class="banner-block">
                        <?php
                        $slider_item_catId = get_theme_mod( 'wp_commerce_frontpage_slider_items');
                        $slider_item_number = get_theme_mod( 'wp_commerce_frontpage_slider_items_number' );
                        $args = array(
                            'post_type'      => 'product',
                            'posts_per_page' => absint( $slider_item_number ),
                            'tax_query'             => array(
                                array(
                                    'taxonomy'      => 'product_cat',
                                    'field' => 'term_id', 
                                    'terms'         => absint( $slider_item_catId )
                                )
                            )
                        );
                        $sliderloop = new WP_Query($args);
                        if ( $sliderloop->have_posts() ) :
                           while ($sliderloop->have_posts()) : $sliderloop->the_post(); 
                            ?>
                            <div class="banner-holder">
                                <?php if(has_post_thumbnail()): ?>
                                    <div class="img-holder">
                                        <?php the_post_thumbnail('wp-commerce-banner-thumb-730*-368'); ?>
                                    </div>
                                    <?php 
                                    else:?>
                                       <div class="img-holder">
                                         <img src="<?php echo esc_url('http://via.placeholder.com/730x369');?>" alt="">
                                     </div>
                                 <?php endif; ?>
                                 <div class="caption">
                                    <?php the_excerpt();?>
                                    <h2><?php the_title();?></h2>
                                    <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e( 'Explore', 'wp-commerce' );?></a>
                                </div>
                            </div>
                        <?php   endwhile;
                        wp_reset_postdata();
                    endif;?>
                </div>      
            </div>
        </div>
    </div>
</section>
<?php endif;?>