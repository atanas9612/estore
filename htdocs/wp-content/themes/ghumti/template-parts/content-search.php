<?php
/**
 * Template part for displaying results in search pages
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

    <?php if( has_post_thumbnail() ) { ?>
        <div class="ghumti-article-thumb">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'ghumti-slider' ); ?>
            </a>
        </div><!-- .ghumti-article-thumb -->
    <?php } ?>
    <div class="ghumti-archive-post-content-wrapper">
    	<header class="entry-header">
    		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    
    		<?php if ( 'post' === get_post_type() ) : ?>
    		<div class="entry-meta">
    			<?php ghumti_posted_on(); ?>
    		</div><!-- .entry-meta -->
    		<?php endif; ?>
    	</header><!-- .entry-header -->
    
    	<div class="entry-summary">
    		<?php the_excerpt(); ?>
    	</div><!-- .entry-summary -->
    
    	<footer class="entry-footer">
    		<?php ghumti_entry_footer(); ?>
    	</footer><!-- .entry-footer -->
     </div><!-- .ghumti-archive-post-content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
