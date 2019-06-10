  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if((is_page_template('template-homepage.php'))):?>
          <div class="navbar-nav category-nav xl-hidden">
              <li class="nav-item">
                  <a class="nav-link" href="#"><?php esc_html_e('Top Categories','wp-commerce');?></a>
              </li>
              <ul class="category-list nav navbar-nav">
                    <?php 
                   $args = array(
                      'taxonomy'=>'product_cat',
                      'number'  => '7'
                  ); 
               $product_categories = get_categories( $args );
               if($product_categories):
                     foreach ( $product_categories as $product_category ):?>
                      <li class="nav-item"><a href="<?php echo esc_url( get_category_link( $product_category ) );?>" class="nav-link"><?php echo esc_html($product_category->name);?></a></li>
                      <?php 
                  endforeach;
              endif;
              ?>
              <li class="nav-item"><a href="<?php echo esc_url(get_post_type_archive_link( 'product' ));?>" class="nav-link"><?php esc_html_e( 'More Categories','wp-commerce' );?></a></li>
              </ul>
          </div>
          <?php endif;?>
       <?php
            if ( has_nav_menu( 'primary' ) ) :
                wp_nav_menu( array(
                'theme_location'    => 'primary',
                'depth'             => 7,
                'menu_class'        => 'nav navbar-nav my-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker(),
            ));
        ?>
        <?php else : ?>
            <ul class="nav navbar-nav my-nav">
                <li class="nav-item">
                     <a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?> " class="nav-link"> <?php esc_html_e('Add a menu','wp-commerce'); ?></a>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</div>
</nav>