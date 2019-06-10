(function ($) {
  "use strict";
  $(document).ready(function(){
    $('.banner .banner-block').slick({
      dots: false,
      infinite: true,
      arrows:true,
      speed: 300,
      slidesToShow: 1,
      autoplay:true,
      slidesToScroll: 1
    });
  });

  $(document).ready(function(){
    $('.feature-product .product-holder .row').slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      ]
    });
  });

  $(document).ready(function(){
    $('.new-arrival .product-holder .row').slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      ]
    });
  });

  $(document).ready(function(){
    $('.hot-product .product-holder .row').slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      ]
    });
  });

  $(document).ready(function(){
    $(".sizes ul li").click(function (e) {
      e.preventDefault();
      $(this).siblings(".sizes ul li").removeClass("active").end().addClass("active");
    });
  });


  $(document).ready(function(){
    if ( $('.product__slider-main').length ) {
      var $slider = $('.product__slider-main')
      .on('init', function(slick) {
        $('.product__slider-main').fadeIn(1000);
      })
      .slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        autoplay: false,
        lazyLoad: 'ondemand',
        autoplaySpeed: 3000,
        adaptiveHeight: true,
        asNavFor: '.product__slider-thmb'
      });

      var $slider2 = $('.product__slider-thmb')
      .on('init', function(slick) {
        $('.product__slider-thmb').fadeIn(1000);
      })
      .slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        lazyLoad: 'ondemand',
        asNavFor: '.product__slider-main',
        dots: false,
        centerMode: false,
        focusOnSelect: true
      });

   //remove active class from all thumbnail slides
   $('.product__slider-thmb .slick-slide').removeClass('slick-active');

   //set active class to first thumbnail slides
   $('.product__slider-thmb .slick-slide').eq(0).addClass('slick-active');

   // On before slide change match active thumbnail to current slide
   $('.product__slider-main').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
    var mySlideNumber = nextSlide;
    $('.product__slider-thmb .slick-slide').removeClass('slick-active');
    $('.product__slider-thmb .slick-slide').eq(mySlideNumber).addClass('slick-active');
  });


    // init slider
    (['js-sliderWithProgressbar'], function(slider) {

      $('.product__slider-main').each(function() {

        me.slider = new slider($(this), options, sliderOptions, previewSliderOptions);
      });
    });
    var options = {
      progressbarSelector    : '.bJS_progressbar'
      , slideSelector        : '.bJS_slider'
      , previewSlideSelector : '.bJS_previewSlider'
      , progressInterval     : ''
      , onCustomProgressbar : function($slide, $progressbar) {}
    }

    var sliderOptions = {
      slidesToShow   : 1,
      slidesToScroll : 1,
      arrows         : false,
      fade           : true,
      autoplay       : true
    }


    var previewSliderOptions = {
      slidesToShow   : 3,
      slidesToScroll : 1,
      dots           : false,
      focusOnSelect  : true,
      centerMode     : true
    }
  }
});

  $(document).ready(function(){
    $('.product__slider-main .slide').zoom();
  });



  $.fn.select2ulCurrency = function() {

    var wrapper = ".ulCurrencyWrapper";
    var containerCurrency = "#ulCurrency";
    var select = this.selector;
    var id = this.attr("id") || "";
    var className = this.attr("class") || "";

    $(select).wrap("<div class='customList' data-id='" + id + "' data-class='" + className + "'>");
    $(select).parent().prepend("<ul class='" + wrapper.substr(1) + "'><li><span></span><ul id='" + containerCurrency.substr(1) + "'>");

    $(wrapper).click(function() {
      $(containerCurrency).toggle();
    });


    $(wrapper + " > li:first-child > span").text($(select + " option:selected").text());

    $(select + " > option").each(function(i, val) {
      var value = $(this).val();
      $(containerCurrency).append("<li class=" + value + ">" + "<a>" + val.innerHTML); 
    });



    $('body').on('click', containerCurrency + " li", function () {
      $(wrapper + " > li:first-child > span").text($(this).find("a").text());
      var selected = $(this).attr("class");
      $(select + " > option").attr("selected", false);
      $(select + " > option[value='" + selected + "']").attr("selected", true);
      $(select).change();
    });

    $(document).click(function (e) {
      if (!$(wrapper).is(e.target) && $(wrapper).has(e.target).length === 0) {
        $(wrapper).find(containerCurrency).hide();
      }
    });
  }

  $("select[name='wcj-currency']").select2ulCurrency();

  $.fn.select2ulCategory = function() {

    var wrapper = ".ulCategoryWrapper";
    var containerCategory = "#ulCategory";
    var select = this.selector;
    var id = this.attr("id") || "";
    var className = this.attr("class") || "";

    $(select).wrap("<div class='customList' data-id='" + id + "' data-class='" + className + "'>");
    $(select).parent().prepend("<ul class='" + wrapper.substr(1) + "'><li><span></span><ul id='" + containerCategory.substr(1) + "'>");


    $(wrapper).click(function() {
      $(containerCategory).toggle();
    });
    $(wrapper + " > li:first-child > span").text($(select + " option:selected").text());



    $(select + " > option").each(function(i, val) {
      var value = $(this).val();
      $(containerCategory).append("<li class=" + value + ">" + "<a>" + val.innerHTML); 
    });

    $('body').on('click', containerCategory + " li", function () {
      $(wrapper + " > li:first-child > span").text($(this).find("a").text());
      var selected = $(this).attr("class");
      $(select + " > option").attr("selected", false);
      $(select + " > option[value='" + selected + "']").attr("selected", true);
      $(select).change();
    });

    $(document).click(function (e) {
      if (!$(wrapper).is(e.target) && $(wrapper).has(e.target).length === 0) {
        $(wrapper).find(containerCategory).hide();
      }
    });
  }
  $("select[name='product_cat']").select2ulCategory();
})(jQuery);




