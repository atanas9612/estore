jQuery(document).ready(function($) {

    "use strict";

    if($('body').hasClass("rtl")) {
        var rtlValue = true;
    } else {
        var rtlValue = false;
    }

    //add custom scroll bar to header cart
    $(".cart-box .widget_shopping_cart ul.cart_list").mCustomScrollbar({
        scrollInertia: 500,
    });

    /**
     * Ticker script
     */
     $("#newsTicker").owlCarousel({
        items: 1,
        loop: true,
        dots: false,
        autoplay: true,
        rtl: rtlValue,
        slideTransition:'',
        nav: true,
        navText: ['<i class="fa fa-chevron-down"></i>','<i class="fa fa-chevron-up"></i>'],
    });

    /**
     * Slider script
     */
     $(".ghumti-main-slider, .ghumti-product-carousel, .ghumti-sale-slide").owlCarousel({
        items: 1,
        loop: true,
        dots: false,
        autoplay: true,
        loop: true,
        autoHeight: true,
        rtl: rtlValue,
        nav: true,
        navText: ['<i class="fa fa-chevron-down"></i>','<i class="fa fa-chevron-up"></i>'],
    });

    /**
    *    Product sliders
    */
    
    $(".ghumti-product-slider, .ghumti-wrap-dealsslider .ghumti-deal-products").owlCarousel({
        items: 4,
        loop: true,
        dots: false,
        autoplay: true,
        rtl: rtlValue,
        margin: 30,
        nav: true,
        navText: ['<i class="fa fa-chevron-down"></i>','<i class="fa fa-chevron-up"></i>'], 
        responsive : {
            0 : {
                items: 1
            },
            641 : {
                items: 2
            },
            993 : {
                items: 4
            }
        }
    });

    if($('.ghumti-product-slider .owl-nav').hasClass('disabled')){
        $('.ghumti-product-slider').addClass('nav-disabled');
    }else {
        $('.ghumti-product-slider').removeClass('nav-disabled');
    }

    $(".ghumti-catproduct").owlCarousel({
        items: 3,
        loop: true,
        dots: false,
        autoplay: true,
        margin: 25,
        rtl: rtlValue,
        nav: true,
        navText: ['<i class="fa fa-chevron-down"></i>','<i class="fa fa-chevron-up"></i>'],
        responsive : {
            0 : {
                items: 1
            },
            641 : {
                items: 2
            },
            993 : {
                items: 3
            }
        }
    });

    //Search toggle
    $('.ghumti-header-search-wrapper .search-form-main').hide();
    $('.ghumti-header-search-wrapper .search-main').click(function() {
        if($('.search-form-main').hasClass('active-search')){
            $('.search-form-main').removeClass('active-search');
            $('.search-form-main').slideUp();
        }else{
            $('.search-form-main').addClass('active-search');
            $('.search-form-main').slideDown();
        }
    });
    $(window).click(function(e){
        var container = $(".ghumti-header-search-wrapper");
        if (!container.is(e.target) && container.has(e.target).length === 0){
            container.children('.search-form-main').slideUp();
            container.children('.search-form-main').removeClass('active-search');   
        }
    });

    
    var winWidth = $('.site').width();
    var wrapWidth = $('.site-header .at-container').width();
    var subVal = parseInt(winWidth) - parseInt(wrapWidth);
    var halfVal = parseInt(subVal) / 2;
    //console.log(halfVal);
    $('.ghumti-ticker-wrapper .ticker-caption').css('padding-left', halfVal);
    $('.ghumti-ticker-wrapper .ticker-content-wrapper').css('padding-right', halfVal);

    //submenu toggle
    if($(window).width() <= 992) {
        $($('.top-navigation').prepend('<button class="toggle-menu">top navigation</button>'));
        $('.top-navigation .toggle-menu').on('click', function(){
            $('.top-navigation').toggleClass('menu-active');
            $('.top-navigation .menu').slideToggle();
        });
        $('.top-navigation ul li.menu-item-has-children').prepend('<span class="toggle"><i class="fa fa-chevron-down"></i></span>');


        $('.main-navigation ul li.menu-item-has-children').prepend('<span class="toggle"><i class="fa fa-chevron-down"></i></span>');
        $('.menu-item-has-children .toggle').on('click', function(){
            $(this).toggleClass('active');
            $(this).siblings('ul').slideToggle();
        });

        $('.main-navigation ul.nav-menu').prepend('<span class="close"></span>');
        $('.main-navigation .toggle-btn').on('click', function(){
            $(this).parent('.main-navigation').addClass('menu-toggled');
        });
        $('.main-navigation ul.nav-menu .close').on('click', function(){
            $('.main-navigation').removeClass('menu-toggled');
        });
    }

    /**
     * Scroll To Top
     */
     $('#ghumti-scrollup').hide();
     $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('#ghumti-scrollup').fadeIn('slow');
        } else {
            $('#ghumti-scrollup').fadeOut('slow');
        }
    });

     $('#ghumti-scrollup').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

 });