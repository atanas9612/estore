<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ghumti_body_classes( $classes ) {

    global $post;
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    /**
     * Sidebar option for post/page/archive
     *
     * @since 1.0.0
     */
    if( 'post' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'ghumti_single_post_sidebar', true );
    }

    if( 'page' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'ghumti_single_post_sidebar', true );
    }

    if( is_home() ) {
        $home_id = get_option( 'page_for_posts' );
        $sidebar_meta_option = get_post_meta( $home_id, 'ghumti_single_post_sidebar', true );
    }
    
    if( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
        $sidebar_meta_option = 'default_sidebar';
    }

    if(is_404()){
        $sidebar_meta_option = 'no_sidebar';
    }

    $archive_sidebar        = get_theme_mod( 'ghumti_archive_sidebar', 'right_sidebar' );
    $post_default_sidebar   = get_theme_mod( 'ghumti_default_post_sidebar', 'right_sidebar' );        
    $page_default_sidebar   = get_theme_mod( 'ghumti_default_page_sidebar', 'right_sidebar' );
    
    if( $sidebar_meta_option == 'default_sidebar' ) {
        if( is_single() ) {
            if( $post_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif( $post_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif( $post_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar';
            } elseif( $post_default_sidebar == 'no_sidebar_center' ) {
                $classes[] = 'no-sidebar-center';
            }
        } elseif( is_page() && !is_page_template( 'templates/home-template.php' ) ) {
            if( $page_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif( $page_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif( $page_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar';
            } elseif( $page_default_sidebar == 'no_sidebar_center' ) {
                $classes[] = 'no-sidebar-center';
            }
        } elseif( $archive_sidebar == 'right_sidebar' ) {
            $classes[] = 'right-sidebar';
        } elseif( $archive_sidebar == 'left_sidebar' ) {
            $classes[] = 'left-sidebar';
        } elseif( $archive_sidebar == 'no_sidebar' ) {
            $classes[] = 'no-sidebar';
        } elseif( $archive_sidebar == 'no_sidebar_center' ) {
            $classes[] = 'no-sidebar-center';
        }
    } elseif( $sidebar_meta_option == 'right_sidebar' ) {
        $classes[] = 'right-sidebar';
    } elseif( $sidebar_meta_option == 'left_sidebar' ) {
        $classes[] = 'left-sidebar';
    } elseif( $sidebar_meta_option == 'no_sidebar' ) {
        $classes[] = 'no-sidebar';
    } elseif( $sidebar_meta_option == 'no_sidebar_center' ) {
        $classes[] = 'no-sidebar-center';
    }

    /**
     * option for web site layout 
     */
    $ghumti_website_layout = esc_attr( get_theme_mod( 'ghumti_site_layout', 'fullwidth_layout' ) );
    
    if( !empty( $ghumti_website_layout ) ) {
        $classes[] = $ghumti_website_layout;
    }

    /**
     * Class for archive
     */
    if( is_archive() ) {
        $ghumti_archive_layout = get_theme_mod( 'ghumti_archive_layout', 'classic' );
        if( !empty( $ghumti_archive_layout ) ) {
            $classes[] = 'archive-'.$ghumti_archive_layout;
        }
    }

    return $classes;
}
add_filter( 'body_class', 'ghumti_body_classes' );

/*---------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Register Google fonts for Ghumti.
 *
 * @return string Google fonts URL for the theme.
 * @since 1.0.0
 */
if ( ! function_exists( 'ghumti_fonts_url' ) ) :
    function ghumti_fonts_url() {
        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Montserrat, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'ghumti' ) ) {
            $font_families[] = 'Montserrat:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i';
        }       

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles for only admin
 *
 * @since 1.0.0
 */
add_action( 'admin_enqueue_scripts', 'ghumti_admin_scripts' );

function ghumti_admin_scripts( $hook ) {

    global $ghumti_version;

    wp_enqueue_script( 'jquery-ui-button' );

    wp_enqueue_script( 'ghumti-admin-script', get_template_directory_uri() .'/assets/js/ghumti-admin-scripts.js', array( 'jquery' ), esc_attr( $ghumti_version ), true );

    wp_enqueue_style( 'ghumti-admin-style', get_template_directory_uri() . '/assets/css/ghumti-admin-style.css', array(), esc_attr( $ghumti_version ) );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function ghumti_scripts() {

    global $ghumti_version;

    wp_enqueue_style( 'ghumti-fonts', ghumti_fonts_url(), array(), null );

    wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

    wp_enqueue_style( 'lightslider-style', get_template_directory_uri().'/assets/library/owl/owl.carousel.min.css', array(), '2.3.4' );

    wp_enqueue_style( 'customscrollbar-style', get_template_directory_uri().'/assets/css/jquery.mCustomScrollbar.css', array(), '2.3.4' );

    wp_enqueue_style( 'ghumti-style', get_stylesheet_uri(), array(), esc_attr( $ghumti_version ) );
    
    wp_enqueue_style( 'ghumti-responsive-style', get_template_directory_uri().'/assets/css/ghumti-responsive.css', array(), '1.0.0' );

    wp_enqueue_script( 'ghumti-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), esc_attr( $ghumti_version ), true );

    wp_enqueue_script( 'ghumti-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), esc_attr( $ghumti_version ), true );

    wp_enqueue_script( 'jquery-lightslider', get_template_directory_uri().'/assets/library/owl/owl.carousel.min.js', array('jquery'), '2.3.4', true );

    wp_enqueue_script( 'jquery-countdown', get_template_directory_uri() .'/assets/js/jquery.countdown.js', array( 'jquery' ), esc_attr( $ghumti_version ), true );

    wp_enqueue_script( 'jquery-customscrollbar', get_template_directory_uri() .'/assets/js/jquery.mCustomScrollbar.js', array( 'jquery' ), esc_attr( $ghumti_version ), true );

    wp_enqueue_script( 'ghumti-custom-script', get_template_directory_uri().'/assets/js/ghumti-custom-scripts.js', array('jquery'), esc_attr( $ghumti_version ), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ghumti_scripts' );

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Social media function
 *
 * @since 1.0.0
 */

if( !function_exists( 'ghumti_social_media' ) ):
    function ghumti_social_media() {
        $get_social_media_icons = get_theme_mod( 'social_media_icons', '' );
        $get_decode_social_media = json_decode( $get_social_media_icons );
        if( ! empty( $get_decode_social_media ) ) {
            echo '<div class="ghumti-social-icons-wrapper">';
            foreach ( $get_decode_social_media as $single_icon ) {
                $icon_class = $single_icon->social_icon_class;
                $icon_url = $single_icon->social_icon_url;
                if( !empty( $icon_url ) ) {
                    echo '<span class="social-link"><a href="'. esc_url( $icon_url ) .'" target="_blank"><i class="'. esc_attr( $icon_class ) .'"></i></a></span>';
                }
            }
            echo '</div><!-- .ghumti-social-icons-wrapper -->';
        }
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Category list
 *
 * @return array();
 */

if( !function_exists( 'ghumti_categories_lists' ) ):
    function ghumti_categories_lists() {
        $ghumti_cat_args = array(
            'type'       => 'post',
            'child_of'   => 0,
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => 1,
            'taxonomy'   => 'category',
        );
        $ghumti_categories = get_categories( $ghumti_cat_args );
        $ghumti_categories_lists = array();
        foreach( $ghumti_categories as $category ) {
            $ghumti_categories_lists[esc_attr( $category->slug )] = esc_html( $category->name );
        }
        return $ghumti_categories_lists;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Product Category list
 *
 * @return array();
 */

if( !function_exists( 'ghumti_woocommerce_categories_lists' ) ):
    function ghumti_woocommerce_categories_lists() {
        $ghumti_cat_args = array(
            'taxonomy'     => 'product_cat',
            'orderby'      => 'name',
            'show_count'   => 0,
            'pad_counts'   => 0,
            'hierarchical' => 1,
            'title_li'     => '',
            'hide_empty'   => 0
        );
        $ghumti_woocommerce_categories_lists = array();
        $woocommerce_categories_obj = get_categories($ghumti_cat_args);
        $ghumti_woocommerce_categories_lists[''] = 'Select Product Category:';
        foreach ($woocommerce_categories_obj as $category) {
            $ghumti_woocommerce_categories_lists[$category->term_id] = $category->name;
        }
        return $ghumti_woocommerce_categories_lists;
    }
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * Add cat id in menu class
 */
function ghumti_category_nav_class( $classes, $item ){
    if( 'category' == $item->object ){
        $category = get_category( $item->object_id );
        $classes[] = 'ghumti-cat-' . absint( $category->term_id );
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'ghumti_category_nav_class', 10, 2 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Get minified css and removed space
 *
 * @since 1.0.0
 */
function ghumti_css_strip_whitespace( $css ){
    $replace = array(
        "#/\*.*?\*/#s" => "",  // Strip C style comments.
        "#\s\s+#"      => " ", // Strip excess whitespace.
    );
    $search = array_keys( $replace );
    $css = preg_replace( $search, $replace, $css );

    $replace = array(
        ": "  => ":",
        "; "  => ";",
        " {"  => "{",
        " }"  => "}",
        ", "  => ",",
        "{ "  => "{",
        ";}"  => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} "  => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys( $replace );
    $css = str_replace( $search, $replace, $css );

    return trim( $css );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_hover_color' ) ) :
    function ghumti_hover_color( $hex, $steps ) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max( -255, min( 255, $steps ) );

        // Normalize into a six character long hex string
        $hex = str_replace( '#', '', $hex );
        if ( strlen( $hex ) == 3) {
            $hex = str_repeat( substr( $hex,0,1 ), 2 ).str_repeat( substr( $hex, 1, 1 ), 2 ).str_repeat( substr( $hex,2,1 ), 2 );
        }

        // Split into three parts: R, G and B
        $color_parts = str_split( $hex, 2 );
        $return = '#';

        foreach ( $color_parts as $color ) {
            $color   = hexdec( $color ); // Convert to decimal
            $color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
            $return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
        }

        return $return;
    }
endif;

/*---------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Function define about page/post/archive sidebar
 *
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_get_sidebar' ) ):
    function ghumti_get_sidebar() {
        global $post;

        if( 'post' === get_post_type() ) {
            $sidebar_meta_option = get_post_meta( $post->ID, 'ghumti_single_post_sidebar', true );
        }

        if( 'page' === get_post_type() ) {
            $sidebar_meta_option = get_post_meta( $post->ID, 'ghumti_single_post_sidebar', true );
        }

        if( is_home() ) {
            $set_id = get_option( 'page_for_posts' );
            $sidebar_meta_option = get_post_meta( $set_id, 'ghumti_single_post_sidebar', true );
        }

        if( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
            $sidebar_meta_option = 'default_sidebar';
        }

        $archive_sidebar      = get_theme_mod( 'ghumti_archive_sidebar', 'right_sidebar' );
        $post_default_sidebar = get_theme_mod( 'ghumti_default_post_sidebar', 'right_sidebar' );
        $page_default_sidebar = get_theme_mod( 'ghumti_default_page_sidebar', 'right_sidebar' );

        if( $sidebar_meta_option == 'default_sidebar' ) {
            if( is_single() ) {
                if( $post_default_sidebar == 'right_sidebar' ) {
                    get_sidebar();
                } elseif( $post_default_sidebar == 'left_sidebar' ) {
                    get_sidebar( 'left' );
                }
            } elseif( is_page() ) {
                if( $page_default_sidebar == 'right_sidebar' ) {
                    get_sidebar();
                } elseif( $page_default_sidebar == 'left_sidebar' ) {
                    get_sidebar( 'left' );
                }
            } elseif( $archive_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $archive_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif( $sidebar_meta_option == 'right_sidebar' ) {
            get_sidebar();
        } elseif( $sidebar_meta_option == 'left_sidebar' ) {
            get_sidebar( 'left' );
        }
    }
endif;

/*---------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Define font awesome social media icons
 *
 * @return array();
 * @since 1.0.0
 */
if( ! function_exists( 'ghumti_font_awesome_social_icon_array' ) ) :
    function ghumti_font_awesome_social_icon_array(){
        return array(
            "fa fa-facebook-square","fa fa-facebook-f","fa fa-facebook","fa fa-facebook-official","fa fa-twitter-square","fa fa-twitter","fa fa-yahoo","fa fa-google","fa fa-google-wallet","fa fa-google-plus-circle","fa fa-google-plus-official","fa fa-instagram","fa fa-linkedin-square","fa fa-linkedin","fa fa-pinterest-p","fa fa-pinterest","fa fa-pinterest-square","fa fa-google-plus-square","fa fa-google-plus","fa fa-youtube-square","fa fa-youtube","fa fa-youtube-play","fa fa-vimeo","fa fa-vimeo-square",
        );
    }
endif;


/*---------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Dynamic style about template
 *
 * @since 1.0.0
 */

add_action( 'wp_enqueue_scripts', 'ghumti_dynamic_styles' );

if( ! function_exists( 'ghumti_dynamic_styles' ) ) :
    function ghumti_dynamic_styles() {

        $ghumti_site_title_option = get_theme_mod( 'ghumti_site_title_option', true );
        $ghumti_site_title_color = get_theme_mod( 'ghumti_site_title_color', '#1c1b1b' );

        $header_bg_v = get_header_image();

        $output_css = '';

        if ( $ghumti_site_title_option === true ) {
            $output_css .=".site-branding .site-title a, .site-branding .site-description {
                color:". esc_attr( $ghumti_site_title_color ) .";
            }\n";
        } else {
            $output_css .=".site-branding .site-title, .site-branding .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }\n";
        }

        if(($header_bg_v)){
            $output_css .=   '.site-header { background: url("'.esc_url($header_bg_v).'") no-repeat scroll left top rgba(0, 0, 0, 0); position: relative; background-size: cover; }';
            $output_css .= "\n";
            $output_css .= '.site-header:before {
                content: "";
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                background: rgba(255,255,255,0.5);
            }';
            $output_css .= "\n";
        }

        $refine_output_css = ghumti_css_strip_whitespace( $output_css );

        wp_add_inline_style( 'ghumti-style', $refine_output_css );
    }
endif;

if(!function_exists('ghumti_ocdi_import_files')){
    /** adding ocdi compatibility */
    function ghumti_ocdi_import_files() {
        return array(
            array(
                'import_file_name'             => 'Ghumti Demo',
                //'categories'                   => array( 'Category 1', 'Category 2' ),
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/demo-data/demo-content.xml',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/demo-data/widgets-data.wie',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'assets/demo-data/customizer-settings.dat',
                'import_preview_image_url'     => get_template_directory_uri().'/screenshot.jpg',
                'import_notice'                => __( 'After you import this demo, you might have to setup the menu separately.', 'ghumti' ),
                'preview_url'                  => 'https://aquariusthemes.com/demo/ghumti/',
            )
        );
    }
}
add_filter( 'pt-ocdi/import_files', 'ghumti_ocdi_import_files' );

if(!function_exists('ghumti_ocdi_after_import')){
    function ghumti_ocdi_after_import( $selected_import ) {
    // Assign menus to their locations.
        $main_menu = get_term_by( 'name', 'primary menu', 'nav_menu' );

        set_theme_mod( 'nav_menu_locations', array(
            'ghumti_primary_menu' => $main_menu->term_id,
            'ghumti_top_menu' => $main_menu->term_id,
            'ghumti_footer_menu' => $main_menu->term_id
        ));

    // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Home' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
    }
}
add_action( 'pt-ocdi/after_import', 'ghumti_ocdi_after_import' );