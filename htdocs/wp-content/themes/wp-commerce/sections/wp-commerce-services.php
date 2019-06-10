<?php $wp_commerce_frontpage_service_option = get_theme_mod( 'wp_commerce_frontpage_service_option', 'show' );
if( $wp_commerce_frontpage_service_option == 'show' ) :?>
<section class="services block">
    <div class="container">
        <div class="row">
            <?php
                $service_catId = get_theme_mod( 'wp_commerce_frontpage_service_category');
                $service_number = get_theme_mod( 'wp_commerce_frontpage_service_items_number');
            
                $args = array(
                'post_type' => 'post',
                'posts_per_page' => absint( $service_number ),
                'post_status' => 'publish',
                'paged' => 1,
                'cat' => absint( $service_catId ),
                   
                );
                $serviceloop = new WP_Query($args);
                if ( $serviceloop->have_posts() ) :
                    while ($serviceloop->have_posts()) : $serviceloop->the_post(); 
                    ?>
                <div class="col-md-4">
                    <div class="card">
                      <?php if(has_post_thumbnail()): ?>
                        <div class="img-holder">
                            <?php the_post_thumbnail('wp-commerce-service-thumbs-98-*-64'); ?>
                        </div>
                      <?php endif;?>
                        <div class="card-body">
                            <h4><?php the_title();?></h4>
                            <?php the_content();?>
                        </div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>
<?php endif;?>