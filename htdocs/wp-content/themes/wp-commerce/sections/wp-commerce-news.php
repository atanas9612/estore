<?php $wp_commerce_frontpage_latest_news_option = get_theme_mod( 'wp_commerce_frontpage_latest_news_option', 'show' );
if( $wp_commerce_frontpage_latest_news_option == 'show' ) :?>
    <section class="news block">
        <div class="container">
            <div class="main-title">
                <h4><?php echo esc_html(get_theme_mod('wp_commerce_frontpage_latest_news_text'));?></h4>
                <?php $latestnewsCategoryId = get_theme_mod('wp_commerce_frontpage_latest_news_category');?>
                <a href="<?php echo esc_url(get_category_link($latestnewsCategoryId));?>" class="view-btn"><span class="fa fa-arrow-right"></span><?php echo esc_html__('View all','wp-commerce');?></a>
            </div>
            <div class="row">
                <?php
                $latestnewsnumber = get_theme_mod( 'wp_commerce_frontpage_latest_news_items_number');
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => absint( $latestnewsnumber ),
                    'post_status' => 'publish',
                    'paged' => 1,
                    'cat' => absint( $latestnewsCategoryId )
                );
                $latestnewsloop = new WP_Query($args);
                if ( $latestnewsloop->have_posts() ) :
                    while ($latestnewsloop->have_posts()) : $latestnewsloop->the_post(); 
                        ?>
                        <div class="col-md-4">
                            <div class="card">
                             <?php if(has_post_thumbnail()): ?>
                                <div class="img-holder">
                                    <?php the_post_thumbnail('wp-commerce-news-thumbs-348-*-212'); ?>
                                </div>
                            <?php endif;?>

                            <div class="card-body">
                                <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e( 'Read More', 'wp-commerce' ) ;?></a>
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