<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

if( has_post_thumbnail() ) {
	$post_class = 'has-thumbnail';
} else {
	$post_class = 'no-thumbnail';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
	
	<?php if(has_post_thumbnail()){ ?>
		<div class="ghumti-article-thumb">
			<?php the_post_thumbnail( 'ghumti-slider' ); ?>
		</div><!-- .ghumti-article-thumb -->
	<?php }?>
	<div class="ghumti-archive-post-content-wrapper">
		<header class="entry-header">
			<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php ghumti_inner_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
			endif;
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			the_excerpt();
			$ghumti_archive_read_more_text = get_theme_mod( 'ghumti_archive_read_more_text', __( 'Continue Reading', 'ghumti' ) );
			?>
			<span class="ghumti-archive-more"><a href="<?php the_permalink(); ?>" class="ghumti-button"><i class="fa fa-arrow-circle-o-right"></i><?php echo esc_html( $ghumti_archive_read_more_text ); ?></a></span>
		</div><!-- .entry-content -->


		<footer class="entry-footer">
			<?php ghumti_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div> <!-- ghumti-archive-post-content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->