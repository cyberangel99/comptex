 ;(function($){
  jQuery(document).ready(function () {
    'use strict';
 

   
    /*** =====================================
    * Progress
    * ==================================== ***/
    jQuery(window).on('scroll', function() {
        var windowHeight = $(window).height();
        function kalProgress() {
           var progress = $('.progress-rate');
           var len = progress.length;
           for (var i = 0; i < len; i++) {
               var progressId = '#' + progress[i].id;
               var dataValue = $(progressId).attr('data-value');
               $(progressId).css({'width':dataValue+'%'});
           }
        }
        var progressRateClass = $('.progress-running');
         if ((progressRateClass).length) {
             var progressOffset = $(".progress-running").offset().top - windowHeight;
             if ($(window).scrollTop() > progressOffset) {
                 kalProgress();
             }
         }
     });


    /** =====================================
    * Counter
    * =====================================***/
  $('.counter').counterUp({
        delay: 10,
        time: 1000
    });



  $(window).load(function() {
      /**=====================================
      *  sponsor Carousel
      * =====================================*/
      $('.client-carousel').owlCarousel({
           autoPlay: true,
           pagination: false,
           loop:true,
           navigation:false,
           items: 7,
           itemsDesktop: [1366, 5],
           itemsDesktopSmall: [768,3],
           itemsTablet: [650, 1],
           navigationText: [
             "<i class='fa fa-angle-left'></i>",
             "<i class='fa fa-angle-right'></i>"
             ]
        });

      /**=====================================
      *  Testimonial Two Carousel
      * =====================================*/
      $('.testimonial-carousel').owlCarousel({
         autoPlay: true,
         pagination: true,
         loop:true,
         navigation:false,
         items: 1,
         itemsDesktop: [1366, 1],
         itemsDesktopSmall: [768,1],
         itemsTablet: [650, 1],
         itemsMobile: 1,
         navigationText: [
           "<i class='fa fa-angle-left'></i>",
           "<i class='fa fa-angle-right'></i>"
           ]
      });
      /**=====================================
      *  service Carousel
      * =====================================*/
      $('.service-carousel').owlCarousel({
           autoPlay: true,
           pagination: false,
           loop:true,
           navigation:false,
           items: 5,
           itemsDesktop: [1366, 4],
           itemsDesktopSmall: [1024,3],
           itemsTablet: [767, 1],
           navigationText: [
             "<i class='fa fa-angle-left'></i>",
             "<i class='fa fa-angle-right'></i>"
             ]
        });
      /**=====================================
      *  Work Carousel
      * =====================================*/
      $('.work-carousel').owlCarousel({
           autoPlay: true,
           pagination: true,
           loop:true,
           navigation:false,
           items: 5,
           itemsDesktop: [1366, 4],
           itemsDesktopSmall: [1024,3],
           itemsTablet: [650, 1],
           navigationText: [
             "<i class='fa fa-angle-left'></i>",
             "<i class='fa fa-angle-right'></i>"
             ]
      });
      /**=====================================
      *  Testimonial Two Carousel
      * =====================================*/
      $('.testimonial-carousel-two-active').owlCarousel({
           autoPlay: true,
           pagination: true,
           loop:true,
           navigation:false,
           items: 3,
           itemsDesktop: [1024, 2],
           itemsDesktopSmall: [768,2],
           itemsTablet: [550, 1],
           itemsMobile: 1,
           navigationText: [
             "<i class='fa fa-angle-left'></i>",
             "<i class='fa fa-angle-right'></i>"
             ]
      });
    });


    /** =====================================
  *  Popup Vccc
  * ===================================== **/
      jQuery('.image-popup-vertical-fit').magnificPopup({
        type: 'image',
      mainClass: 'mfp-with-zoom', 
      gallery:{
                enabled:true
            },

      zoom: {
        enabled: true, 

        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function

        opener: function(openerElement) {
          return openerElement.is('img') ? openerElement : openerElement.find('img');
      }
    }

    });



    /** =====================================
    *   Search Box
    * =====================================**/
    $('.search-box .search-icon').on('click', function(e) {
        e.preventDefault();
        $('.top-search-input-wrap').addClass('show');
    });
    $(".top-search-input-wrap .top-search-overlay, .top-search-input-wrap .close-icon").on('click', function(){
        $('.top-search-input-wrap').removeClass('show');
    });

    /*** =====================================
    *   Mobile Menu
    * =====================================***/
  $('.mobile-background-nav .has-submenu').on('click', function(e) {
      e.preventDefault();
      var $this = $(this);
      if ($this.next().hasClass('menu-show')) {
          $this.next().removeClass('menu-show');
          $this.next().slideUp(350);
      } else {
          $this.parent().parent().find('li .dropdown').removeClass('menu-show');
          $this.parent().parent().find('li .dropdown').slideUp(350);
          $this.next().toggleClass('menu-show');
          $this.next().slideToggle(350);
      }
  });
  $('.mobile-menu-close i').on('click',function(){
       $('.mobile-background-nav').removeClass('in');
  });

  $('.mobile-logo-search-humbarger .humbarger-button i').on('click',function(){
       $('.mobile-background-nav').toggleClass('in');
  });

  var windowHeight = $(window).height();
  $(".mobile-background-nav .mobile-inner").css({"height": windowHeight});
  $(window).on('resize',function(){
      var windowHeight = $(window).height();
    var windowWidth = $(window).width();
      if (windowWidth < 991) {
          $(".mobile-background-nav .mobile-inner").css({"height": windowHeight});
      }
  });


  /*
  |----------------------------------------------------------------------------
  |  Navbar collapse
  |----------------------------------------------------------------------------
  */
  var windowWidth = $(window).width();
  if (windowWidth < 992) {
     $('li.menu-item-has-children > a').after('<span class="sub-trigger"></span>');
    $( '.menu-item-has-children' ).each(function() { 
          $(this).addClass('navbar-mobile'); 
          $(this).on( 'click', '>.sub-trigger', function() {
            $(this).parent().toggleClass('sub-open');
            $(this).parent().children("ul.sub-menu").slideToggle();
          }); 
      }); 
  }



    /* -------------------------------------------------------------
      MAGNIFIC JS
    ------------------------------------------------------------- */
        $('.popup-play .play-icon').magnificPopup({
          type: 'iframe'
        });
        $.extend(true, $.magnificPopup.defaults, {
          iframe: {
            patterns: {
              youtube: {
                index: 'youtube.com/', 
                id: 'v=', 
                src: 'http://www.youtube.com/embed/%id%?autoplay=1' 
              }
            }
          }
        });




    $('.categoriy-humbarger .icon').on('click', function(){
        $('.categories-widget').toggleClass('hidden-widget');
    });
    /** =====================================
    * Match Height
    * =====================================***/
    $('.match-height-active > div').matchHeight();
    /*** =====================================
    * Gallery Filter
    * ==================================== ***/
  $(window).on('load', function(){
        /*** =====================================
          *   Fixed Menu
          * =====================================*/
         var win = $(window);
         var menuTerget = $('.desktop-menu');
         var menuOffset = menuTerget.offset().top;
         win.on('scroll', function() {
             if (menuOffset < win.scrollTop()) {
                 menuTerget.addClass('main-menu-fix');
             } else {
                 menuTerget.removeClass('main-menu-fix');
             }
         });
        /** ===== Preloder ========**/
      $('.preloader').fadeOut();

    if($('.gallery-grid').length){
      var $grid = $('.gallery-grid').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-item',
            }
        });
      //$('.gallery-grid .zoom-button').simpleLightbox();
    }
    
    $('.gallery-filter ul li a').on('click', function() {
          var filterValue = $(this).attr('data-filter');
          $( '.gallery-filter ul li a').removeClass('selected');
          $( this ).addClass('selected');
          $grid.isotope({
                filter: filterValue
        });
      });
  });
    /** =====================================
    *  Color Swicher
    * ===================================== **/
  $('.swhicher-button button').on('click', function(){
    var buttonAttr = $(this).attr('data-att');
    $('link[data-style="color-style"]').attr('href','css/'+buttonAttr+'.css');
        $('.logo a img, .footer-logo a img').attr('src','images/'+buttonAttr+'-logo.png');
  });
  $('.setting-button-wrapper .setting-button').on('click', function(){
    $('.color-shicher-wraper').toggleClass('show-color');
  });
    /** =====================================
    *  Wow JS
    * ===================================== **/
    if($('.wow').length){
        var wow=new WOW( {
            boxClass: 'wow', // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 0, // distance to the element when triggering the animation (default is 0)
            mobile: false, // trigger animations on mobile devices (default is true)
            live: true, // act on asynchronously loaded content (default is true)
            callback: function(box) {}
            , scrollContainer: true // optional scroll container selector, otherwise use window
        }
        );
        wow.init();
    }

    /* -------------------------------------------------------------
      Scroll To Top
    ------------------------------------------------------------- */
    $.scrollUp({
      scrollText: '<i class="fa fa-angle-up"></i>',
    });


    /** =====================================
    *  Shop Rating
    * ===================================== **/
    function shoprating() {
          var shopRate = $('.shop-rating');
          var len = shopRate.length;
          for (var i = 0; i < len; i++) {
             var shopRateId = '#' + shopRate[i].id;
             var dataValue = $(shopRateId).attr('data-value');
              $(shopRateId).rateYo({
                 rating: dataValue,
                 starWidth: "13px",
                 normalFill: "#212121",
                 spacing   : "5px",
                 ratedFill: "#ff4e00"
             });
          }
     }
     if($('.shop-rating').length) {
         shoprating();
     }
     $('.cart-close i').on('click', function(){
      $(this).parents('tr').fadeOut();
     });
});

 }(jQuery));