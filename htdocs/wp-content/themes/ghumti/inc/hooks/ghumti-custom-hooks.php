<?php
/**
 * Custom hooks functions are define.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Related Posts start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_related_posts_start' ) ) :
	function ghumti_related_posts_start() {
		echo '<div class="ghumti-related-section-wrapper">';
	}
endif;

/**
 * Related Posts section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_related_posts_section' ) ) :
	function ghumti_related_posts_section() {
		$ghumti_related_option = get_theme_mod( 'ghumti_related_posts_option', 'show' );
		if( $ghumti_related_option == 'hide' ) {
			return;
		}
		$ghumti_related_title = get_theme_mod( 'ghumti_related_posts_title', __( 'Related Posts', 'ghumti' ) );
		if( !empty( $ghumti_related_title ) ) {
			echo '<h2 class="ghumti-related-title ghumti-clearfix">'. esc_html( $ghumti_related_title ) .'</h2>';
		}
		global $post;
        if( empty( $post ) ) {
            $post_id = '';
        } else {
            $post_id = $post->ID;
        }
        $categories = get_the_category( $post_id );
        if ( $categories ) {
            $category_ids = array();
            foreach( $categories as $category_ed ) {
                $category_ids[] = $category_ed->term_id;
            }
        }
		$ghumti_post_count = apply_filters( 'ghumti_related_posts_count', 3 );
		
		$related_args = array(
				'no_found_rows'            	=> true,
                'update_post_meta_cache'   	=> false,
                'update_post_term_cache'   	=> false,
                'ignore_sticky_posts'      	=> 1,
                'orderby'                  	=> 'rand',
                'post__not_in'             	=> array( $post_id ),
                'category__in'				=> $category_ids,
				'posts_per_page' 		   	=> $ghumti_post_count
			);
		$related_query = new WP_Query( $related_args );
		if( $related_query->have_posts() ) {
			echo '<div class="ghumti-related-posts-wrap ghumti-clearfix">';
			while( $related_query->have_posts() ) {
				$related_query->the_post();
	?>
				<div class="ghumti-single-post ghumti-clearfix">
					<div class="ghumti-post-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'ghumti-block-medium' ); ?>
						</a>
					</div><!-- .ghumti-post-thumb -->
					<div class="ghumti-post-content">
						<h3 class="ghumti-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="ghumti-post-meta">
							<?php ghumti_posted_on(); ?>
						</div>
					</div><!-- .ghumti-post-content -->
				</div><!-- .ghumti-single-post -->
	<?php
			}
			echo '</div><!-- .ghumti-related-posts-wrap -->';
			wp_reset_postdata();
		}
	}
endif;

/**
 * Related Posts end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_related_posts_end' ) ) :
	function ghumti_related_posts_end() {
		echo '</div><!-- .ghumti-related-section-wrapper -->';
	}
endif;

/**
 * Managed functions for related posts section
 *
 * @since 1.0.0
 */
add_action( 'ghumti_related_posts', 'ghumti_related_posts_start', 5 );
add_action( 'ghumti_related_posts', 'ghumti_related_posts_section', 10 );
add_action( 'ghumti_related_posts', 'ghumti_related_posts_end', 15 );