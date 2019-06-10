<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'ghumti_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ghumti_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( ' %s', 'post date', 'ghumti' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( ' %s', 'post author', 'ghumti' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Post date for hoemapge posts
 */
if( ! function_exists( 'ghumti_post_date' ) ) :
	function ghumti_post_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( ' %s', 'post date', 'ghumti' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		echo '<span class="posted-on">' . wp_kses($posted_on,array('a','time','span')) . '</span>';
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Post date for hoemapge posts
 */
if( ! function_exists( 'ghumti_post_date_blog' ) ) :
	function ghumti_post_date_blog() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s"><span class="day">%2$s</span><span class="month">%3$s</span></time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s"><span class="day">%2$s</span><span class="month">%3$s</span></time><time class="updated" datetime="%4$s"><span class="day">%5$s</span><span class="month">%6$s</span></time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_attr( get_the_date( 'j' ) ),
			esc_html( get_the_date('F') ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_attr( get_the_modified_date( 'j' ) ),
			esc_html( get_the_modified_date('F') )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( ' %s', 'post date', 'ghumti' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		//echo '<span class="posted-on">' . wp_kses($posted_on,array('a'=>array('href'=>array(),'rel'=>array()),'time'=>array('class'=>array(),'datetime'=>array()),'span'=>array('class'=>array()))) . '</span>';
		echo '<span class="posted-on">' . ($posted_on) . '</span>'; // WPCS: XSS OK.
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Post author for homepage posts
 */
if( ! function_exists( 'ghumti_post_author' ) ) :
	function ghumti_post_author() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'ghumti' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		echo '<span class="byline"> ' . wp_kses_post($byline) . '</span>'; // WPCS: XSS OK.
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Comment for homepage post
 */
if( ! function_exists( 'ghumti_post_comment' ) ) :
	
	function ghumti_post_comment() {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( '0 ', 'ghumti' ), esc_html__( '1 ', 'ghumti' ), esc_html__( '% ', 'ghumti' ) );
		echo '</span>';
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'ghumti_inner_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ghumti_inner_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( ' %s', 'post date', 'ghumti' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( ' %s', 'post author', 'ghumti' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( '0 ', 'ghumti' ), esc_html__( '1 ', 'ghumti' ), esc_html__( '% ', 'ghumti' ) );
		echo '</span>';
	}

}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'ghumti_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function ghumti_entry_footer() {

	if ( is_single() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'ghumti' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'ghumti' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
	
	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'ghumti' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if(!function_exists('ghumti_categorized_blog')){
	function ghumti_categorized_blog() {
		$all_the_cool_cats = get_transient( 'ghumti_categories' );
		if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,
			// We only need to know if there is more than one category.
				'number'     => 2,
			) );

		// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'ghumti_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 || is_preview() ) {
		// This blog has more than 1 category so ghumti_categorized_blog should return true.
			return true;
		} else {
		// This blog has only 1 category so ghumti_categorized_blog should return false.
			return false;
		}
	}
}
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Flush out the transients used in ghumti_categorized_blog.
 */
if(!function_exists('ghumti_category_transient_flusher')){
	function ghumti_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
	// Like, beat it. Dig?
		delete_transient( 'ghumti_categories' );
	}
}
add_action( 'edit_category', 'ghumti_category_transient_flusher' );
add_action( 'save_post',     'ghumti_category_transient_flusher' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Categories list in multiple color background
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_post_categories_list' ) ):
	function ghumti_post_categories_list() {
		global $post;
		$post_id = $post->ID;
		$categories_list = get_the_category($post_id);
		if( !empty( $categories_list ) ) {
			?>
			<div class="post-cats-list">
				<?php 
				foreach ( $categories_list as $cat_data ) {
					$cat_name = $cat_data->name;
					$cat_id = $cat_data->term_id;
					$cat_link = get_category_link( $cat_id );
					?>
					<span class="category-button ghumti-cat-<?php echo esc_attr( $cat_id ); ?>"><a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a></span>
					<?php 
				}
				?>
			</div>
			<?php
		}
	}
endif;