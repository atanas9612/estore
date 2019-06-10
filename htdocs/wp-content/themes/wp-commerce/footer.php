<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP Commerce
 */
?>
<footer class="footer">
    <div class="container">
        <div class="top-content">
            <?php
            if ( has_nav_menu( 'footer-1' ) ) {
                wp_nav_menu( array(
                    'theme_location'    => 'footer-1',
                    'depth'             => 1,
                    'menu_class'        => 't-nav',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker(),
                ));
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="left-content">
                    <div class="m-header">
                        <div class="logo">
                            <a href="<?php echo esc_url( home_url('/') );?>">
                                <h1 class="site-title"><?php bloginfo('name');?></h1>
                                <span class="b-title site-description"><?php bloginfo('description');?></span>
                            </a>
                        </div>
                    </div>
                    <div class="copyright">
                     <?php /* translators: 1: Current Date, 2: Theme name, 3: Theme author. */
                     printf( esc_html__( 'Copyright %1$s %2$s. All Rights Reserved. Powered by %3$s', 'wp-commerce' ), esc_html(date('Y')), esc_html(get_bloginfo('name')), '<a href="http://wpcodethemes.com/">wpcodethemes</a>' );
                     ?>
                 </div>
             </div>
         </div>
         <div class="col-md-5 p-0 border">
            <div class="center-content">

                <?php if (get_theme_mod('wp_commerce_subscribe_shortcode')):
                    echo do_shortcode(get_theme_mod('wp_commerce_subscribe_shortcode')); 
                endif; ?>
                <?php
                if ( has_nav_menu( 'footer-2' ) ) {
                    wp_nav_menu( array(
                        'theme_location'    => 'footer-2',
                        'depth'             => 1,
                        'menu_class'        => 't-nav',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker(),
                    ));
                }
                ?>
            </div>
        </div>
        <div class="col-md-3 pl-0">
            <div class="right-content">
                <?php $wp_commerce_footer_social_option = get_theme_mod( 'wp_commerce_footer_social_option', 'show' );
                if( $wp_commerce_footer_social_option == 'show' ) :?>
                    <ul class="social-icons">
                        <?php 
                        $social_name_arrays = array(
                            'fa fa-facebook'=>'Facebook',
                            'fa fa-twitter'=>'Twitter',
                            'fa fa-dribbble'=>'Dribble',
                            'fa fa-linkedin'=>'Linkedin',
                        );
                        ?>
                        <?php foreach($social_name_arrays as $key=>$social_name):
                            if(get_theme_mod( 'wp_commerce_footer_social_url_'.$social_name)):                
                                ?>
                                <li><a href="<?php echo esc_url(get_theme_mod( 'wp_commerce_footer_social_url_'.$social_name))?>"><span class="<?php echo esc_attr( $key );?>"></span></a></li>
                            <?php endif;?>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>

                <?php $wp_commerce_footer_payment_method_option = get_theme_mod( 'wp_commerce_footer_payment_method_option', 'show' );
                if( $wp_commerce_footer_payment_method_option == 'show' ) :?>
                    <ul class="payment-method">
                     <?php 
                     $payment_method_arrays = array(
                        'fa fa-cc-mastercard'=>'master-card',
                        'fa fa-cc-paypal'=>'paypal',
                        'fa fa-cc-visa'=>'visa-card',
                    );
                    ?>
                    <?php foreach($payment_method_arrays as $key=>$payment_method):
                        if(get_theme_mod( 'wp_commerce_footer_payment_method_url_'.$payment_method)):                
                            ?>
                            <li><a href="<?php echo esc_url(get_theme_mod('wp_commerce_footer_payment_method_url_'.$payment_method));?>">
                                <span class="<?php echo esc_attr($key);?>" style="font-size:36px"></span></a></li>
                            <?php endif;?>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
