<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP Commerce
 */

?>

<div class="col-md-6">
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
	            <li><?php $categories = get_the_category(); 
						$cat_name = $categories[0]->cat_name;
						echo esc_html($cat_name);
	            ?></li>
	            <li><?php wp_commerce_posted_by();?></li>
	            <li class="date"><?php wp_commerce_posted_on();?></li>
	          </ul>
	          <?php the_content();?>
	          <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e('Read more','wp-commerce');?></a>
	          <span class="cmt"><?php echo esc_html(get_comments_number());?> <?php esc_html_e('Comments','wp-commerce');?></span>
	        </div>
	      </div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
