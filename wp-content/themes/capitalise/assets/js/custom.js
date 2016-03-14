;(function($, window, undefined) {

	"use strict";

	jQuery(document).ready(function ($) {
		
		// TODO Lazyload Images
		/*
		function lazyLoadInit() {
			$('.projects img').one('inview', function() {
				$(this).addClass('show-element');
			});	
		}
		lazyLoadInit();*/
		
		// Sticky Navigation
		$('.header-sticky').waypoint(function( direction ) {
			
			var $header = $('#main-header');
			
			if ( direction == 'down' ) {
				$header.css('top', $('body').offset().top ).addClass('sticky');
			} else if ( direction == 'up' ) {
				$header.css( 'top', '0').removeClass( 'sticky' );
			}
		}, { offset: $('body').offset().top });

		// Main Search Toggle
		$(".search-menu-button .search-link").on('click', function() {
        	$('.header-search-wrap').fadeToggle('fast');
        });

		// Main Naiviation Scripts
		$('nav.main-navigation > ul > li.menu-item-has-children').each(function(){
			$(this).find('> a').append('<i class="fa fa-angle-down"></i>');
		});


		// Portfolio Filter (Isotope)
		var portfolioGrid = $('#projects-grid');

		portfolioGrid.imagesLoaded(function(){
		    portfolioGrid.isotope({
			    itemSelector: '.project-item',
			    layoutMode: 'masonry',
			    masonry: { 
			    	columnWidth: '.project-item',
			    	//isFitWidth: true
			    }
			});
		});

		var filterFns = {
		    // show if number is greater than 50
		    numberGreaterThan50: function() {
		      var number = $(this).find('.number').text();
		      return parseInt( number, 10 ) > 50;
		    },
		    // show if name ends with -ium
		    ium: function() {
		      var name = $(this).find('.name').text();
		      return name.match( /ium$/ );
		    }
		};

      	$('#projects-filter').on('click', 'a', function() {
		    var filterValue = $( this ).attr('data-filter');
		    // use filterFn if matches value
		    filterValue = filterFns[ filterValue ] || filterValue;
		    portfolioGrid.isotope({ filter: filterValue });
		    return false;
		});

      	// change is-checked class on buttons
		$('#projects-filter').each( function( i, buttonGroup ) {
	    	var $buttonGroup = $( buttonGroup );
	    	$buttonGroup.on('click', 'a', function() {
	      		$buttonGroup.find('.active').removeClass('active');
	      		$( this ).addClass('active');
	    	});
	  	});

		// Flexslider Testimonials
		$('.testimonials').flexslider({
            animationLoop: true,
            slideshow: true,
            useCSS: false,
            directionNav: false,
            pauseOnAction: true,
            pauseOnHover: false,
            animation: 'fade',
            itemMargin: 25,
            minItems: 1,
            maxItems: 1,
			animationSpeed: 600,
            slideshowSpeed: 5000,
        });


        // Parallax Background
        if ($(window).outerWidth() > 1024) {
			$(window).stellar({
				horizontalScrolling: false,
			});
		}

        // Blog Masonry
        var blogIsotope = function(){
            var imgLoad = imagesLoaded($('.blog-isotope'));
		   
            imgLoad.on('done', function(){

                $('.blog-isotope').isotope({
                    "itemSelector": ".blog-post",
                });
               
            });
           
           imgLoad.on('fail', function(){

                $('.blog-isotope').isotope({
                    "itemSelector": ".blog-post",
                });

           });  
           
        };
                   
        blogIsotope();

		// Off Canvas Navigation
		var offcanvas_open = false;
		var offcanvas_from_left = false;

		function offcanvas_right() {
			
			$('.sidebar-menu-container').addClass("slide-from-left");
			$('.sidebar-menu-container').addClass("sidebar-menu-open");		
			
			offcanvas_open = true;
			offcanvas_from_left = true;
			
			$('.sidebar-menu').addClass('open');
			$('body').addClass('offcanvas_open offcanvas_from_left');

			$('.nano').nanoScroller();
			
		}

		function offcanvas_close() {
			if (offcanvas_open === true) {
					
				$('.sidebar-menu-container').removeClass('slide-from-left');
				$('.sidebar-menu-container').removeClass('sidebar-menu-open');
				
				offcanvas_open = false;
				offcanvas_from_left = false;
				
				//$('#sidebar-menu-container').css('max-height', 'inherit');
				$('.sidebar-menu').removeClass('open');
				$('body').removeClass('offcanvas_open offcanvas_from_left');

			}
		}

		$('.side-menu-button').on( 'click', function() {
			offcanvas_right();
		});

		$('#sidebar-menu-container').on('click', '.sidebar-menu-overlay' , function(e) {
			offcanvas_close();
		});

		$('.sidebar-menu-overlay').swipe({
			swipeLeft:function(event, direction, distance, duration, fingerCount) {
				offcanvas_close();
			},
			swipeRight:function(event, direction, distance, duration, fingerCount) {
				offcanvas_close();
			},
			tap:function(event, direction, distance, duration, fingerCount) {
				offcanvas_close();
			},
			threshold:0
		});

		// Mobile navigation
		$('.responsive-menu .menu-item-has-children').append('<div class="show-submenu"><i class="fa fa-chevron-circle-down"></i></div>');

	    $('.responsive-menu').on('click', '.show-submenu', function(e) {
			e.stopPropagation();
			
			$(this).parent().toggleClass('current').children('.sub-menu').toggleClass('open');
							
			$(this).html($(this).html() == '<i class="fa fa-chevron-circle-down"></i>' ? '<i class="fa fa-chevron-circle-up"></i>' : '<i class="fa fa-chevron-circle-down"></i>');
			$('.nano').nanoScroller();
		});

		$('.responsive-menu').on('click', 'a', function(e) {
			if( ($(this).attr('href') === "#") || ($(this).attr('href') === "") ) {
				$(this).parent().children(".show-submenu").trigger('click');
				return false;
			} else {
				offcanvas_close();
			}
		});

		//  go to top
      	var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.go-top');

		//hide or show the "back to top" link
		$(window).scroll(function(){
			( $(this).scrollTop() > offset ) ? $back_to_top.addClass('go-top-visible') : $back_to_top.removeClass('go-top-visible go-top-fade-out');
			if( $(this).scrollTop() > offset_opacity ) { 
				$back_to_top.addClass('go-top-fade-out');
			}
		});

		//smooth scroll to top
		$back_to_top.on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0 ,
			 	}, scroll_top_duration
			);
		});

	});

})(jQuery, window);