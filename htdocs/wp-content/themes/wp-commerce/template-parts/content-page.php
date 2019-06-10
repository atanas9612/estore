<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP Commerce
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="card">
		<div class="img-holder">
			<?php the_post_thumbnail('wp-commerce-blog-thumb'); ?>
		</div>
		<div class="card-body">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>
			<ul class="blog-info">
				<?php if(!is_checkout() && !(is_cart()) ):?>
				<li><?php wp_commerce_posted_by();?></li>
				<li class="date"><?php wp_commerce_posted_on();?></li>
			<?php endif;?>
			
		</ul>
		<?php the_content();?>
		
		<span class="cmt"><?php echo esc_html(get_comments_number());?> <?php esc_html_e('Comments','wp-commerce');?></span>
	</div>
</div>
<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wp-commerce' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
</article><!-- #post-<?php the_ID(); ?> -->

