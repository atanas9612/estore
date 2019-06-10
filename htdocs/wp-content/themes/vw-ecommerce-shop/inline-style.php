<?php
	
	/*---------------------------First highlight color-------------------*/

	$vw_ecommerce_shop_first_color = get_theme_mod('vw_ecommerce_shop_first_color');

	$custom_css = '';

	if($vw_ecommerce_shop_first_color != false){
		$custom_css .='.yearwrap,.side_search input[type="submit"], input[type="submit"], .scrollup i, .footer .custom-social-icons i:hover, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce div.product form.cart .button:hover, .woocommerce #review_form #respond .form-submit input, .sidebar ul li::before, .sidebar .custom-social-icons i:hover, .date-monthwrap, .hvr-sweep-to-right:before, li.woocommerce-MyAccount-navigation-link.woocommerce-MyAccount-navigation-link, .woocommerce .cart .button, .woocommerce .cart input.button:hover, a.checkout-button.button.alt.wc-forward:hover, .woocommerce .woocommerce-error .button, .woocommerce .woocommerce-info .button, .woocommerce .woocommerce-message .button, .woocommerce-page .woocommerce-error .button, .woocommerce-page .woocommerce-info .button, .woocommerce-page .woocommerce-message .button:hover, .pagination .current, .pagination a:hover, .sidebar input[type="submit"]{';
			$custom_css .='background-color: '.esc_html($vw_ecommerce_shop_first_color).';';
		$custom_css .='}';
	}
	if($vw_ecommerce_shop_first_color != false){
		$custom_css .='.sidebar ul li::before, #comments input[type="submit"].submit{';
			$custom_css .='background-color: '.esc_html($vw_ecommerce_shop_first_color).'!important;';
		$custom_css .='}';
	}
	if($vw_ecommerce_shop_first_color != false){
		$custom_css .='a, .header .logo h1 a, .top-contact i, .topbar .custom-social-icons i:hover, .header .nav ul li a:hover, li.drp_dwn_menu a:hover, .slider .more-btn a, .footer h3, .sidebar h3, .sidebar .custom-social-icons i, .post-main-box h3, .blogbutton-small, h2.single-post-title, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, .metabox i{';
			$custom_css .='color: '.esc_html($vw_ecommerce_shop_first_color).';';
		$custom_css .='}';
	}
	if($vw_ecommerce_shop_first_color != false){
		$custom_css .='.blogbutton-small, .pagination span, .pagination a, .pagination .current{';
			$custom_css .='border-color: '.esc_html($vw_ecommerce_shop_first_color).'!important;';
		$custom_css .='}';
	}
	if($vw_ecommerce_shop_first_color != false){
		$custom_css .='.footer-2{';
			$custom_css .='border-top-color: '.esc_html($vw_ecommerce_shop_first_color).';';
		$custom_css .='}';
	}

	/*---------------------------Width Layout -------------------*/

	$theme_lay = get_theme_mod( 'vw_ecommerce_shop_width_option','Full Width');
    if($theme_lay == 'Boxed'){
		$custom_css .='body{';
			$custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$custom_css .='}';
	}else if($theme_lay == 'Wide Width'){
		$custom_css .='body{';
			$custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$custom_css .='}';
	}else if($theme_lay == 'Full Width'){
		$custom_css .='body{';
			$custom_css .='max-width: 100%;';
		$custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$theme_lay = get_theme_mod( 'vw_ecommerce_shop_slider_opacity_color','0.5');
	if($theme_lay == '0'){
		$custom_css .='.slider img{';
			$custom_css .='opacity:0';
		$custom_css .='}';
		}else if($theme_lay == '0.1'){
		$custom_css .='.slider img{';
			$custom_css .='opacity:0.1';
		$custom_css .='}';
		}else if($theme_lay == '0.2'){
		$custom_css .='.slider img{';
			$custom_css .='opacity:0.2';
		$custom_css .='}';
		}else if($theme_lay == '0.3'){
		$custom_css .='.slider img{';
			$custom_css .='opacity:0.3';
		$custom_css .='}';
		}else if($theme_lay == '0.4'){
		$custom_css .='.slider img{';
			$custom_css .='opacity:0.4';
		$custom_css .='}';
		}else if($theme_lay == '0.5'){
		$custom_css .='.slider img{';
			$custom_css .='opacity:0.5';
		$custom_css .='}';
		}else if($theme_lay == '0.6'){
		$custom_css .='.slider img{';
			$custom_css .='opacity:0.6';
		$custom_css .='}';
		}else if($theme_lay == '0.7'){
		$custom_css .='.slider img{';
			$custom_css .='opacity:0.7';
		$custom_css .='}';
		}else if($theme_lay == '0.8'){
		$custom_css .='.slider img{';
			$custom_css .='opacity:0.8';
		$custom_css .='}';
		}else if($theme_lay == '0.9'){
		$custom_css .='.slider img{';
			$custom_css .='opacity:0.9';
		$custom_css .='}';
		}

	/*---------------------------Slider Content Layout -------------------*/

	$theme_lay = get_theme_mod( 'vw_ecommerce_shop_slider_content_option','Left');
    if($theme_lay == 'Left'){
		$custom_css .='.slider .carousel-caption, .slider .inner_carousel, .slider .inner_carousel h2{';
			$custom_css .='text-align:left; left:15%; right:45%;';
		$custom_css .='}';
	}else if($theme_lay == 'Center'){
		$custom_css .='.slider .carousel-caption, .slider .inner_carousel, .slider .inner_carousel h2{';
			$custom_css .='text-align:center; left:20%; right:20%;';
		$custom_css .='}';
	}else if($theme_lay == 'Right'){
		$custom_css .='.slider .carousel-caption, .slider .inner_carousel, .slider .inner_carousel h2{';
			$custom_css .='text-align:right; left:45%; right:15%;';
		$custom_css .='}';
	}