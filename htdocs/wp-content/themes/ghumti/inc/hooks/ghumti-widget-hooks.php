<?php
/**
 * Custom hooks functions for different layout in widget section.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Default Layout
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_block_default_layout_section' ) ) :
	function ghumti_block_default_layout_section( $cat_slug ) {
		if( empty( $cat_slug ) ) {
			return;
		}
		$ghumti_post_count = apply_filters( 'ghumti_block_default_posts_count', 3 );
		$block_args = array(
			'category_name'  => esc_attr( $cat_slug ),
			'posts_per_page' => absint( $ghumti_post_count ),
		);
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if( $block_query->have_posts() ) {
			while( $block_query->have_posts() ) {
				$block_query->the_post();
				?>
				<div class="ghumti-single-post">
					<?php if( has_post_thumbnail() ) { ?>
						<div class="ghumti-post-thumb">
							<?php ghumti_post_date_blog(); ?>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'ghumti-featured-medium' );?>
							</a>
						</div><!-- .ghumti-post-thumb -->
					<?php } ?>
					<div class="ghumti-post-content">
						<div class="ghumti-post-meta">
							<?php
							ghumti_post_author();
							ghumti_post_comment();
							?>
						</div>
						<h3 class="ghumti-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="ghumti-post-excerpt">
							<?php the_excerpt(); ?>
							<a class="ghumti-read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Continue Reading','ghumti');?></a>
						</div>
					</div><!-- .ghumti-post-content -->
				</div><!-- .ghumti-single-post -->
				<?php
			}
			wp_reset_postdata();
		}
	}
endif;