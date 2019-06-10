<?php
/**
 * Custom hooks functions are define about header section.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Top header start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_top_header_start' ) ) :
	function ghumti_top_header_start() {
		echo '<div class="ghumti-top-header-wrap">';
		echo '<div class="at-container">';
	}
endif;

/**
 * Top header left section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_top_left_section' ) ) :
	function ghumti_top_left_section() {
		?>
		<div class="ghumti-top-left-section-wrapper">
			<?php if ( has_nav_menu( 'ghumti_top_menu' ) ) { ?>
			<nav id="top-navigation" class="top-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'ghumti_top_menu', 'menu_id' => 'top-menu' ) );
				?>
			</nav><!-- #site-navigation -->
			<?php
		} ?>
	</div><!-- .ghumti-top-left-section-wrapper -->
	<?php
}
endif;

/**
 * Top header end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_top_header_end' ) ) :
	function ghumti_top_header_end() {
		echo '</div><!-- .at-container -->';
		echo '</div><!-- .ghumti-top-header-wrap -->';
	}
endif;

/**
 * Managed functions for top header hook
 *
 * @since 1.0.0
 */
add_action( 'ghumti_top_header', 'ghumti_top_header_start', 5 );
add_action( 'ghumti_top_header', 'ghumti_top_left_section', 10 );
add_action( 'ghumti_top_header', 'ghumti_top_header_end', 25 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Ticker section start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_ticker_section_start' ) ) :
	function ghumti_ticker_section_start() {
		echo '<div class="ghumti-ticker-wrapper">';
		echo '<div class="at-container">';
		echo '<div class="ghumti-ticker-block ghumti-clearfix">';
	}
endif;

/**
 * Ticker content area
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_ticker_content' ) ) :
	function ghumti_ticker_content() {
		$ghumti_ticker_caption = get_theme_mod( 'ghumti_ticker_caption', __( 'Breaking News', 'ghumti' ) );
		?>
		<span class="ticker-caption"><?php echo esc_html( $ghumti_ticker_caption ); ?></span>
		<div class="ticker-content-wrapper">
			<?php
			$ghumti_ticker_cat_id = apply_filters( 'ghumti_ticker_cat_id', null );
			$ticker_args = array(
				'cat' => $ghumti_ticker_cat_id,
				'posts_per_page' => '5'
			);
			$ticker_query = new WP_Query( $ticker_args );
			if( $ticker_query->have_posts() ) {
				echo '<ul id="newsTicker" class="owl-carousel">';
				while( $ticker_query->have_posts() ) {
					$ticker_query->the_post();
					?>			
					<li><div class="news-ticker-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></div></li>
					<?php
				}
				echo '</ul>';
				wp_reset_postdata();
			}
			?>
		</div><!-- .ticker-content-wrapper -->
		<?php
	}
endif;

/**
 * Ticker section end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_ticker_section_end' ) ) :
	function ghumti_ticker_section_end() {
		echo '</div><!-- .ghumti-ticker-block -->';
		echo '</div><!-- .at-container -->';
		echo '</div><!-- .ghumti-ticker-wrapper -->';
	}
endif;

/**
 * Managed functions for ticker section
 *
 * @since 1.0.0
 */
add_action( 'ghumti_ticker_section', 'ghumti_ticker_section_start', 5 );
add_action( 'ghumti_ticker_section', 'ghumti_ticker_content', 10 );
add_action( 'ghumti_ticker_section', 'ghumti_ticker_section_end', 15 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * header section start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_header_section_start' ) ) :
	function ghumti_header_section_start() {
		echo '<header id="masthead" class="site-header" role="banner">';
	}
endif;

/**
 * header logo and icons section start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_header_logo_icons_section_start' ) ) :
	function ghumti_header_logo_icons_section_start() {
		echo '<div class="ghumti-logo-section-wrapper">';
		echo '<div class="at-container">';
	}
endif;

/**
 * Logo header left section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_logo_left_section' ) ) :
	function ghumti_logo_left_section() {
		?>
		<div class="ghumti-logo-left-section-wrapper">
			<?php
			$ghumti_top_social_option = get_theme_mod( 'ghumti_top_social_option', 'show' );
			if( $ghumti_top_social_option == 'show' ) {
				ghumti_social_media();
			}
			?>
		</div><!-- .ghumti-top-right-section-wrapper -->
		<?php
	}
endif;

/**
 * site branding section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_site_branding_section' ) ) :
	function ghumti_site_branding_section() {
		?>
		<div class="site-branding">
			<?php
			if ( the_custom_logo() ) { ?>
			<div class="site-logo">
				<?php the_custom_logo(); ?>
			</div><!-- .site-logo -->
			<?php
		}
		if ( is_front_page() && is_home() ) :?>
		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<?php 
	else :
		?>
		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php
	endif;
	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) : ?>
	<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
	<?php
	endif; ?>
</div>
<!-- .site-branding -->
<?php
}
endif;

/**
 * Logo header right section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_logo_right_section' ) ) :
	function ghumti_logo_right_section() {
		$ghumti_top_icons_option = get_theme_mod( 'ghumti_top_icons_option', 'show' );
		if( $ghumti_top_icons_option == 'show' ) {
			?>
			<div class="ghumti-logo-right-section-wrapper">
				<div class="my-account">
					<i class="fa fa-unlock-alt"></i>
					<div class="welcome-user">
						<?php
					//if user is logged in
						if(is_user_logged_in()){
							global $current_user;
							wp_get_current_user();
							?>
							<?php esc_html_e('Welcome', 'ghumti')." ";?>
							<a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>">
								<span class="user-name">
									<?php echo esc_html($current_user->display_name); ?>
								</span>
							</a>
							<?php esc_html_e('!', 'ghumti');?>
							<a href="<?php echo esc_url(wp_logout_url()); ?>" class="logout">
								<?php esc_html_e('Logout','ghumti'); ?>
							</a>
							<?php
						} else{
							if(is_woocommerce_available()){
								woocommerce_login_form();
								?>
								<a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" class="register">
									<?php esc_html_e('Register','ghumti'); ?>
								</a>
								<?php
							}else{
								?>
								<a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" class="login">
									<?php esc_html_e('Login','ghumti'); ?>
								</a>
								<?php 
							}
						}
						?>
					</div>
				</div>
				<!-- Cart Link -->
				<?php 
				if(is_woocommerce_available()):
					?>
					<div class="cart-box">
						<a class="cart-contents" href="<?php echo esc_url( function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : $woocommerce->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'ghumti' ); ?>">
							<div class="count">
								<i class="fa fa-shopping-cart"></i>
								<span class="cart-count"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
							</div>	               	
						</a>
						<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
					</div>
					<?php
				endif;
				?>
				<?php if(class_exists('YITH_WCWL')): ?>
					<div class="wishlist-box">
						<?php $wishlist_count = YITH_WCWL()->count_products(); ?>
						<span class="your-counter-selector"><?php echo esc_html($wishlist_count); ?></span>
						<a title="<?php esc_html_e('Wishlist','ghumti'); ?>" class="wishlist_view" href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>"><i class="fa fa-heart" aria-hidden="true"></i></a>
					</div>
				<?php endif;?>
			</div><!-- .ghumti-top-right-section-wrapper -->
			<?php
		}
	}
endif;

/**
 * header logo and icons section end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_header_logo_icons_section_end' ) ) :
	function ghumti_header_logo_icons_section_end() {
		echo '</div><!-- .at-container -->';
		echo '</div><!-- .ghumti-logo-section-wrapper -->';
	}
endif;

/**
 * header primary menu section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_primary_menu_section' ) ) :
	function ghumti_primary_menu_section() {
		?>
		<div id="ghumti-menu-wrap" class="ghumti-header-menu-wrapper">
			<div class="ghumti-header-menu-block-wrap">
				<div class="at-container">
					<nav id="site-navigation" class="main-navigation" role="navigation">
					<button type="button" class="toggle-btn">
						<span class="toggle-bar"></span>
						<span class="toggle-bar"></span>
						<span class="toggle-bar"></span>
					</button>
						<?php wp_nav_menu( array( 'theme_location' => 'ghumti_primary_menu', 'menu_id' => 'primary-menu' ) );
						?>
					</nav><!-- #site-navigation -->

					<?php
					$ghumti_search_icon_option = get_theme_mod( 'ghumti_search_icon_option', 'show' );
					if( $ghumti_search_icon_option == 'show' ) {
						?>
						<div class="ghumti-header-search-wrapper">                    
							<span class="search-main"><i class="fa fa-search"></i></span>
							<div class="search-form-main">
								<?php get_search_form(); ?>
							</div>
						</div><!-- .ghumti-header-search-wrapper -->
						<?php } ?>
					</div>
				</div>
			</div><!-- .ghumti-header-menu-wrapper -->
			<?php
		}
	endif;

/**
 * header section end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_header_section_end' ) ) :
	function ghumti_header_section_end() {
		echo '</header><!-- .site-header -->';
	}
endif;

/**
 * Managed functions for ticker section
 *
 * @since 1.0.0
 */
add_action( 'ghumti_header_section', 'ghumti_header_section_start', 5 );
add_action( 'ghumti_header_section', 'ghumti_header_logo_icons_section_start', 10 );
add_action( 'ghumti_header_section', 'ghumti_logo_left_section', 15 );
add_action( 'ghumti_header_section', 'ghumti_site_branding_section', 20 );
add_action( 'ghumti_header_section', 'ghumti_logo_right_section', 25 );
add_action( 'ghumti_header_section', 'ghumti_header_logo_icons_section_end', 30 );
add_action( 'ghumti_header_section', 'ghumti_primary_menu_section', 35 );
add_action( 'ghumti_header_section', 'ghumti_header_section_end', 40 );