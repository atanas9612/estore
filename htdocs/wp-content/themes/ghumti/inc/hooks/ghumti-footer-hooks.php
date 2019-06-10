<?php
/**
 * Custom hooks functions are define about footer section.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_footer_start' ) ) :
	function ghumti_footer_start() {
		echo '<footer id="colophon" class="site-footer" role="contentinfo">';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer Top widget section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_top_footer_widget_section' ) ) :
	function ghumti_top_footer_widget_section() {
		$ghumti_footer_layout = get_theme_mod( 'footer_widget_layout', 'column_three' );
		?>
		<div id="top-footer" class="footer-widgets-wrapper footer_<?php echo esc_attr( $ghumti_footer_layout ); ?> ghumti-clearfix">
			<div class="at-container">
				<div class="ghumti-top-footer-widget wow fadeInLeft" data-wow-duration="0.5s">
					<?php
					if ( !dynamic_sidebar( 'ghumti_top_footer' ) ):
					endif;
					?>
				</div>
			</div><!-- .at-container -->
		</div><!-- .footer-widgets-wrapper -->
		<?php
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
* Bottom footer start
*
* @since 1.0.0
*/
if( ! function_exists( 'ghumti_main_footer_start' ) ) :
	function ghumti_main_footer_start() {
		echo '<div class="main-footer ghumti-clearfix">';
		echo '<div class="at-container">';
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
	/**
	* Bottom footer menu
	*
	* @since 1.0.0
	*/
	if( ! function_exists( 'ghumti_footer_menu_section' ) ) :
		function ghumti_footer_menu_section() {
			?>
			<nav id="footer-navigation" class="footer-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'ghumti_footer_menu', 'menu_id' => 'footer-menu' ) );
				?>
			</nav><!-- #site-navigation -->
			<?php
		}
	endif;

	/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer main widget section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_main_footer_widget_section' ) ) :
	function ghumti_main_footer_widget_section() {
		?>
		<div class="main-footer-widgets-area ghumti-clearfix">
			<div class="ghumti-footer-widget-wrapper ghumti-column-wrapper ghumti-clearfix">
				<div class="ghumti-footer-widget wow fadeInLeft" data-woww-duration="1s">
					<?php
					if ( !dynamic_sidebar( 'ghumti_main_footer' ) ):
					endif;
					?>
				</div>
			</div><!-- .ghumti-footer-widget-wrapper -->
		</div><!-- .footer-widgets-area -->
		<?php
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_main_footer_end' ) ) :
	function ghumti_main_footer_end() {
		echo '</div><!-- .at-container -->';
		echo '</div> <!-- bottom-footer -->';
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer side info
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_footer_site_info_section' ) ) :
	function ghumti_footer_site_info_section() {
		?>
		<div class="site-info">
			<span class="ghumti-copyright-text">
				<?php 
				$ghumti_copyright_text = get_theme_mod( 'ghumti_copyright_text', __( 'Ghumti', 'ghumti' ) );
				echo esc_html( $ghumti_copyright_text );
				?>
			</span>
			<span class="sep"> | </span>
			<?php
			$ghumti_author_url = 'http://AquariusThemes.com/';
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'ghumti' ), 'Ghumti', '<a href="'. esc_url( $ghumti_author_url ).'" rel="designer" target="_blank">AquariusThemes</a>' );
			?>
		</div><!-- .site-info -->
		<?php
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_footer_end' ) ) :
	function ghumti_footer_end() {
		echo '</footer><!-- #colophon -->';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Go to Top Icon
 *
 * @since 1.0.0
 */

if( ! function_exists( 'ghumti_go_top' ) ) :
	function ghumti_go_top() {
		echo '<div id="ghumti-scrollup" class="animated arrow-hide"><i class="fa fa-chevron-up"></i></div>';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Managed functions for footer hook
 *
 * @since 1.0.0
 */
add_action( 'ghumti_footer', 'ghumti_footer_start', 5 );
add_action( 'ghumti_footer', 'ghumti_top_footer_widget_section', 10 );
add_action( 'ghumti_footer', 'ghumti_main_footer_start', 15 );
add_action( 'ghumti_footer', 'ghumti_footer_menu_section', 20 );
add_action( 'ghumti_footer', 'ghumti_main_footer_widget_section', 25 );
add_action( 'ghumti_footer', 'ghumti_main_footer_end', 30 );
add_action( 'ghumti_footer', 'ghumti_footer_site_info_section', 35 );
add_action( 'ghumti_footer', 'ghumti_footer_end', 40 );
add_action( 'ghumti_footer', 'ghumti_go_top', 45 );