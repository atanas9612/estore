<div class="m-holder">
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="logo">
                <?php 
                if(has_custom_logo()):
                    ?>
                    <?php the_custom_logo();?>
                    <?php else:?>

                        <h1 class="site-title"> <a href="<?php echo esc_url( home_url('/') );?>"><?php esc_html(bloginfo('title'));?></a></h1>
                        <span class="b-title site-description"><?php esc_html(bloginfo('description'));?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <?php $wp_commerce_header_search_option = get_theme_mod( 'wp_commerce_header_search_option', 'show' );
                if( $wp_commerce_header_search_option == 'show' ) :?>
                    <div class="search">
                        <form class="my-2 my-lg-0 search-form"  method ="get" id="searchform" action="<?php echo esc_url(home_url('/'));?>">
                            <div class="select-category">
                                <?php
                                if ( class_exists( 'WooCommerce' ) ) {  
                                    $args = array(
                                        'taxonomy' => 'product_cat',
                                        'show_option_all' => esc_attr__('All Categories','wp-commerce'),
                                        'class' => 'form-control',
                                        'name' => 'product_cat',
                                        'value_field' => 'slug',
                                        'id'      => 'exampleFormControlSelect1',
                                        'selected' => isset($_GET['product_cat'])?$_GET['product_cat']:'',
                                    );
                                    wp_dropdown_categories( $args );
                                }
                                ?>
                            </div>
                            <input type="text" class="form-control" placeholder="<?php esc_attr_e('Search','wp-commerce');?> ..." value="<?php echo get_search_query(); ?>" name="s" aria-label="Search">
                            <input type="hidden" value="product" name="post_type" id="post_type" />
                            <button class="btn" type="submit"><img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/search.png" alt=""></button>
                        </form>
                    </div>
                <?php endif;?>
            </div>

            <div class="col-lg-4 col-md-12">
                <?php if( wp_commerce_is_woocommerce_activated() ) :?>
                    <?php $wp_commerce_header_cart_option = get_theme_mod( 'wp_commerce_header_cart_option', 'show' );
                    if( $wp_commerce_header_cart_option == 'show' ) :?>
                        <?php wp_commerce_add_to_cart_dropdown();?>
                    <?php endif;?>
            <?php endif;?>
        </div>
    </div>
</div>