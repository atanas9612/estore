<?php
/**
 * Create a metabox to added some custom filed in posts.
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

add_action( 'add_meta_boxes', 'ghumti_post_meta_options' );

if( ! function_exists( 'ghumti_post_meta_options' ) ):
 function  ghumti_post_meta_options() {
    add_meta_box(
        'ghumti_post_meta',
        esc_html__( 'Post Meta Options', 'ghumti' ),
        'ghumti_post_meta_callback',
        'post',
        'normal',
        'high'
    );
    add_meta_box(
        'ghumti_page_meta',
        esc_html__( 'Page Meta Options', 'ghumti' ),
        'ghumti_post_meta_callback',
        'page',
        'normal',
        'high'
    );
}
endif;

$ghumti_post_sidebar_options = array(
    'default-sidebar' => array(
        'id'		=> 'post-default-sidebar',
        'value'     => 'default_sidebar',
        'label'     => esc_html__( 'Default Sidebar', 'ghumti' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/default-sidebar.png'
    ), 
    'left-sidebar' => array(
        'id'		=> 'post-right-sidebar',
        'value'     => 'left_sidebar',
        'label'     => esc_html__( 'Left sidebar', 'ghumti' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png'
    ), 
    'right-sidebar' => array(
        'id'		=> 'post-left-sidebar',
        'value'     => 'right_sidebar',
        'label'     => esc_html__( 'Right sidebar', 'ghumti' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png'
    ),
    'no-sidebar' => array(
        'id'		=> 'post-no-sidebar',
        'value'     => 'no_sidebar',
        'label'     => esc_html__( 'No sidebar Full width', 'ghumti' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png'
    ),
    'no-sidebar-center' => array(
        'id'		=> 'post-no-sidebar-center',
        'value'     => 'no_sidebar_center',
        'label'     => esc_html__( 'No sidebar Content Centered', 'ghumti' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar-center.png'
    )
);

/**
 * Callback function for post option
 */
if( ! function_exists( 'ghumti_post_meta_callback' ) ):
	function ghumti_post_meta_callback() {
		global $post, $ghumti_post_sidebar_options;

        $get_post_meta_identity = get_post_meta( $post->ID, 'post_meta_identity', true );
        $post_identity_value = empty( $get_post_meta_identity ) ? 'ghumti-metabox-info' : $get_post_meta_identity;

        wp_nonce_field( basename( __FILE__ ), 'ghumti_post_meta_nonce' );
        ?>
        <div class="ghumti-meta-container ghumti-clearfix">
           <ul class="ghumti-meta-menu-wrapper">
            <li class="ghumti-meta-tab <?php if( $post_identity_value == 'ghumti-metabox-info' ) { echo 'active'; } ?>" data-tab="ghumti-metabox-info"><span class="dashicons dashicons-clipboard"></span><?php esc_html_e( 'Information', 'ghumti' ); ?></li>
            <li class="ghumti-meta-tab <?php if( $post_identity_value == 'ghumti-metabox-sidebar' ) { echo 'active'; } ?>" data-tab="ghumti-metabox-sidebar"><span class="dashicons dashicons-exerpt-view"></span><?php esc_html_e( 'Sidebars', 'ghumti' ); ?></li>
        </ul><!-- .ghumti-meta-menu-wrapper -->
        <div class="ghumti-metabox-content-wrapper">

            <!-- Info tab content -->
            <div class="ghumti-single-meta active" id="ghumti-metabox-info">
             <div class="content-header">
              <h4><?php esc_html_e( 'About Metabox Options', 'ghumti' ) ;?></h4>
          </div><!-- .content-header -->
          <div class="meta-options-wrap"><?php esc_html_e( 'In this section we have lots of features which make your post unique and completely different.', 'ghumti' ); ?></div><!-- .meta-options-wrap  -->
      </div><!-- #ghumti-metabox-info -->

      <!-- Sidebar tab content -->
      <div class="ghumti-single-meta" id="ghumti-metabox-sidebar">
         <div class="content-header">
          <h4><?php esc_html_e( 'Available Sidebars', 'ghumti' ) ;?></h4>
          <span class="section-desc"><em><?php esc_html_e( 'Select sidebar from available options which replaced sidebar layout from customizer settings.', 'ghumti' ); ?></em></span>
      </div><!-- .content-header -->
      <div class="ghumti-meta-options-wrap">
          <div class="buttonset">
           <?php
           foreach ( $ghumti_post_sidebar_options as $field ) {
            $ghumti_post_sidebar = get_post_meta( $post->ID, 'ghumti_single_post_sidebar', true );
            $ghumti_post_sidebar = ( $ghumti_post_sidebar ) ? $ghumti_post_sidebar : 'default_sidebar';
            ?>
            <input type="radio" id="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" name="ghumti_single_post_sidebar" <?php checked( $field['value'], $ghumti_post_sidebar ); ?> />
            <label for="<?php echo esc_attr( $field['id'] ); ?>">
             <span class="screen-reader-text"><?php echo esc_html( $field['label'] ); ?></span>
             <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" title="<?php echo esc_attr( $field['label'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
         </label>

     <?php } ?>
 </div><!-- .buttonset -->
</div><!-- .meta-options-wrap  -->
</div><!-- #ghumti-metabox-sidebar -->

<div class="clear"></div>
<input type="hidden" id="post-meta-selected" name="post_meta_identity" value="<?php echo esc_attr( $post_identity_value ); ?>" />
</div><!-- .ghumti-meta-container -->
<?php
}
endif;

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Function for save value of meta options
 *
 * @since 1.0.8
 */
add_action( 'save_post', 'ghumti_save_post_meta' );

if( ! function_exists( 'ghumti_save_post_meta' ) ):

    function ghumti_save_post_meta( $post_id ) {

        global $post, $ghumti_allowed_textarea;

    // Verify the nonce before proceeding.
        if(isset( $_POST['ghumti_post_meta_nonce'] )){
            $ghumti_post_nonce   =  sanitize_text_field(wp_unslash($_POST['ghumti_post_meta_nonce']));
        }else{
            $ghumti_post_nonce   =   '';    
        }
        $ghumti_post_nonce_action = basename( __FILE__ );

    //* Check if nonce is set...
        if ( ! isset( $ghumti_post_nonce ) ) {
            return;
        }

    //* Check if nonce is valid...
        if ( ! wp_verify_nonce( $ghumti_post_nonce, $ghumti_post_nonce_action ) ) {
            return;
        }

    //* Check if user has permissions to save data...
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    //* Check if not an autosave...
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }

    //* Check if not a revision...
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

    /**
     * Post sidebar
     */
    $post_sidebar = get_post_meta( $post_id, 'ghumti_single_post_sidebar', true );
    if(isset($_POST['ghumti_single_post_sidebar'])){
        $stz_post_sidebar = sanitize_text_field( wp_unslash($_POST['ghumti_single_post_sidebar']) );
    }
    if ( $stz_post_sidebar && $stz_post_sidebar != $post_sidebar ) {  
        update_post_meta ( $post_id, 'ghumti_single_post_sidebar', $stz_post_sidebar );
    } elseif ( '' == $stz_post_sidebar && $post_sidebar ) {  
        delete_post_meta( $post_id,'ghumti_single_post_sidebar', $post_sidebar );  
    }

    /**
     * post meta identity
     */
    $post_identity = get_post_meta( $post_id, 'post_meta_identity', true );
    if(isset($_POST[ 'post_meta_identity' ])){
        $stz_post_identity = sanitize_text_field( wp_unslash($_POST[ 'post_meta_identity' ]) );
    }
    if ( $stz_post_identity && '' == $stz_post_identity ){
        add_post_meta( $post_id, 'post_meta_identity', $stz_post_identity );
    }elseif ( $stz_post_identity && $stz_post_identity != $post_identity ) {
        update_post_meta($post_id, 'post_meta_identity', $stz_post_identity );
    } elseif ( '' == $stz_post_identity && $post_identity ) {
        delete_post_meta( $post_id, 'post_meta_identity', $post_identity );
    }
}
endif;