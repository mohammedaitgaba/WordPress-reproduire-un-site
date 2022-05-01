/* global wenTravelOptions */
 /*
 * Custom scripts
 * Description: Custom scripts for wen_travel
 */
( function( $ ) {
	jQuery( document ).ready( function() {
		body = jQuery( document.body );
		jQuery( window )
			.on( 'load.corporateBiz resize.corporateBiz', function() {
			if ( window.innerWidth < 1200 ) {
				jQuery('#site-header-menu .menu-inside-wrapper').on('focusout', function () {
					var $elem = jQuery(this);
					// let the browser set focus on the newly clicked elem before check
				    setTimeout(function () {
				    	if ( ! $elem.find(':focus').length ) {
				    		jQuery( '#site-header-menu .menu-toggle' ).trigger('focus');
				        }
				    }, 0);
				});
			}

			jQuery('#primary-search-wrapper .menu-inside-wrapper').on('focusout', function () {
				var $elem = jQuery(this);
				
			    // let the browser set focus on the newly clicked elem before check
			    setTimeout(function () {
			        if ( ! $elem.find(':focus').length ) {
			            jQuery( '#primary-search-wrapper .menu-toggle' ).trigger('focus');
			        }
			    }, 0);
			});

			jQuery('#social-menu-wrapper .menu-inside-wrapper').on('focusout', function () {
				var $elem = jQuery(this);
				
			    // let the browser set focus on the newly clicked elem before check
			    setTimeout(function () {
			        if ( ! $elem.find(':focus').length ) {
			            jQuery( '#social-menu-wrapper .menu-toggle' ).trigger('focus');
			        }
			    }, 0);
			});
		} );

		if ( 'feature-slider-section' === $( '#masthead' ).next().attr("id") ) {
			body.addClass( 'slider-after-header' );
		}
	});
	
	// Owl Carousel
	if ( typeof $.fn.owlCarousel === "function" ) {
		// Featured Slider
		var sliderOptions = {
			rtl:wenTravelOptions.rtl ? true : false,
			autoHeight:true,
			margin: 0,
			items: 1,
			nav: false,
			dots: true,
			autoplay: true,
			autoplayTimeout: 4000,
			loop: true,
			navText: [wenTravelOptions.iconNavPrev,wenTravelOptions.iconNavNext],
		};

		$(".main-slider").owlCarousel(sliderOptions);

		// Testimonial Section
		var testimonialLayout = 3;
		var testimonialOptions = {
			rtl:wenTravelOptions.rtl ? true : false,
			autoHeight: true,
			margin: 0,
			items: 1,
			nav: true,
			dots: true,
			autoplay: true,
			autoplayTimeout: 4000,
			loop: true,
			navText: [wenTravelOptions.iconNavPrev,wenTravelOptions.iconNavNext],
			responsive:{
				0:{
					items:1
				},
				768 :{
					items:( testimonialLayout < 2 ) ? testimonialLayout : 2
				},
				992 :{
					items:( testimonialLayout < 3 ) ? testimonialLayout : 3
				}
			}
		};

		$( '.testimonial-slider' ).owlCarousel(testimonialOptions);
	}

	$( function() {
		//Adding padding top for header to match with custom header
		$( window ).on( 'load.wen_travel resize.wen_travel', function () {
			if ( $( 'body' ).hasClass( 'transparent-header' ) || $( 'body' ).hasClass( 'absolute-header' )) {
				headerheight = $('#masthead').height();
				$('.custom-header').css('padding-top', headerheight );
				$('header + .slider-content-wrapper').css('padding-top', headerheight );
			}
		});

		// Functionality for scroll to top button
		$(window).on( 'scroll', function () {
			if ( $( this ).scrollTop() > 100 ) {
				$( '#scrollup' ).fadeIn('slow');
				$( '#scrollup' ).show();
			} else {
				$('#scrollup').fadeOut('slow');
				$("#scrollup").hide();
			}
		});

		$( '#scrollup' ).on( 'click', function () {
			$( 'body, html' ).animate({
				scrollTop: 0
			}, 500 );
			return false;
		});

		// Fit Vid load
		if ( typeof $.fn.fitVids === "function" ) {
			$('.hentry, .widget').fitVids();
		}
	});

	// Add header video class after the video is loaded.
	$( document ).on( 'wp-custom-header-video-loaded', function() {
		$( 'body' ).addClass( 'has-header-video' );
	});

	/*
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	$( function() {
		$( document ).ready( function() {
			if ( true === supportsInlineSVG() ) {
				document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
			}
		});
	});

	$( '.search-toggle' ).on( 'click', function() {
		$( this ).toggleClass( 'open' );
		$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		$( '.search-wrapper' ).toggle();
	});


	/* Menu */
	var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
		    .append( wenTravelOptions.screenReaderText.icon )
		    .append( $( '<span />', { 'class': 'screen-reader-text', text: wenTravelOptions.expand }) );

		container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children, .page_item_has_children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).on( 'click', function( e ) {
			var _this            = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
			screenReaderSpan.text( screenReaderSpan.text() === wenTravelOptions.screenReaderText.expand ? wenTravelOptions.screenReaderText.collapse : wenTravelOptions.screenReaderText.expand );
		} );
	}

	initMainNavigation( $( '.main-navigation' ) );

	masthead         = $( '#masthead' );
	menuToggle       = masthead.find( '.menu-toggle' );
	siteHeaderMenu   = masthead.find( '#site-header-menu' );
	siteNavigation   = masthead.find( '#site-navigation' );
	socialNavigation = masthead.find( '#social-navigation' );


	// Enable menuToggle.
	( function() {

		// Adds our overlay div.
		$( '.below-site-header' ).prepend( '<div class="overlay">' );

		// Assume the initial scroll position is 0.
		var scroll = 0;

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		menuToggle.on( 'click.wen_travel', function() {
			// jscs:disable
			$( this ).add( siteNavigation ).attr( 'aria-expanded', $( this ).add( siteNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );


		// Add an initial values for the attribute.
		menuToggle.add( siteNavigation ).attr( 'aria-expanded', 'false' );
		menuToggle.add( socialNavigation ).attr( 'aria-expanded', 'false' );

		// Wait for a click on one of our menu toggles.
		menuToggle.on( 'click.wen_travel', function() {

			// Assign this (the button that was clicked) to a variable.
			var button = this;

			// Gets the actual menu (parent of the button that was clicked).
			var menu = $( this ).parents( '.menu-wrapper' );

			// Remove selected classes from other menus.
			$( '.menu-toggle' ).not( button ).removeClass( 'selected' );
			$( '.menu-wrapper' ).not( menu ).removeClass( 'is-open' );

			// Toggle the selected classes for this menu.
			$( button ).toggleClass( 'selected' );
			$( menu ).toggleClass( 'is-open' );

			// Is the menu in an open state?
			var is_open = $( menu ).hasClass( 'is-open' );

			// If the menu is open and there wasn't a menu already open when clicking.
			if ( is_open && ! jQuery( 'body' ).hasClass( 'menu-open' ) ) {

				// Get the scroll position if we don't have one.
				if ( 0 === scroll ) {
					scroll = $( 'body' ).scrollTop();
				}

				// Add a custom body class.
				$( 'body' ).addClass( 'menu-open' );

			// If we're closing the menu.
			} else if ( ! is_open ) {

				$( 'body' ).removeClass( 'menu-open' );
				$( 'body' ).scrollTop( scroll );
				scroll = 0;
			}
		} );

		// Close menus when somewhere else in the document is clicked.
		$( document ).on( 'click touchstart', function() {
			$( 'body' ).removeClass( 'menu-open' );
			$( '.menu-toggle' ).removeClass( 'selected' );
			$( '.menu-wrapper' ).removeClass( 'is-open' );
		} );

		// Stop propagation if clicking inside of our main menu.
		$( '.site-header-menu,.menu-toggle, .dropdown-toggle, .search-field, #site-navigation, #social-search-wrapper, #social-navigation .search-submit' ).on( 'click touchstart', function( e ) {
			e.stopPropagation();
		} );
	} )();

	//For Footer Menu
	menuToggleFooter       = $( '#menu-toggle-footer' ); // button id
	siteFooterMenu         = $( '#footer-menu-wrapper' ); // wrapper id
	siteNavigationFooter   = $( '#site-footer-navigation' ); // nav id
	initMainNavigation( siteNavigationFooter );

	// Enable menuToggleFooter.
	( function() {
		// Return early if menuToggleFooter is missing.
		if ( ! menuToggleFooter.length ) {
			return;
		}

		// Add an initial values for the attribute.
		menuToggleFooter.add( siteNavigationFooter ).attr( 'aria-expanded', 'false' );

		menuToggleFooter.on( 'click', function() {
			$( this ).add( siteFooterMenu ).toggleClass( 'toggled-on selected' );

			// jscs:disable
			$( this ).add( siteNavigationFooter ).attr( 'aria-expanded', $( this ).add( siteNavigationFooter ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );
	} )();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 910 ) {
				$( document.body ).on( 'touchstart.wen_travel', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				} );
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).on( 'touchstart.wen_travel', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.wen_travel' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.wen_travel', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.wen_travel blur.wen_travel', function() {
			$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
		} );

		$('.main-navigation button.dropdown-toggle').on( 'click',function() {
			$(this).toggleClass('active');
			$(this).parent().find('.children, .sub-menu').toggleClass('toggled-on');
		});
	} )();

	// Add the default ARIA attributes for the menu toggle and the navigations.
	function onResizeARIA() {
		if ( window.innerWidth < 910 ) {
			if ( menuToggle.hasClass( 'toggled-on' ) ) {
				menuToggle.attr( 'aria-expanded', 'true' );
			} else {
				menuToggle.attr( 'aria-expanded', 'false' );
			}

			if ( siteHeaderMenu.hasClass( 'toggled-on' ) ) {
				siteNavigation.attr( 'aria-expanded', 'true' );
				socialNavigation.attr( 'aria-expanded', 'true' );
			} else {
				siteNavigation.attr( 'aria-expanded', 'false' );
				socialNavigation.attr( 'aria-expanded', 'false' );
			}

			menuToggle.attr( 'aria-controls', 'site-navigation social-navigation' );
		} else {
			menuToggle.removeAttr( 'aria-expanded' );
			siteNavigation.removeAttr( 'aria-expanded' );
			socialNavigation.removeAttr( 'aria-expanded' );
			menuToggle.removeAttr( 'aria-controls' );
		}
	}

	$(document).ready(function() {
		/*Search and Social Container*/
		$('.toggle-top').on('click', function(e){
			$(this).toggleClass('toggled-on');
		});

		$('#search-toggle').on('click', function(){
			$('#header-menu-social, #share-toggle').removeClass('toggled-on');
			$('#header-search-container').toggleClass('toggled-on');
		});

		$('#share-toggle').on('click', function(e){
			e.stopPropagation();
			$('#header-search-container, #search-toggle').removeClass('toggled-on');
			$('#header-menu-social').toggleClass('toggled-on');
		});
	});

	/* Playlist On Scroll For Mobile */
	var PlaylistOnScroll = function(){

		var scrollTop = $(window).scrollTop();

		if (scrollTop > 46) {
			$('body').addClass('playlist-fixed');
		} else {
			$('body').removeClass('playlist-fixed');
		}
	};

	/*Onload*/
	PlaylistOnScroll();

	/*On Scroll*/
	$(window).on( 'scroll',function() {
		PlaylistOnScroll();
	});

	// Show count in header if count is more than 0
	if (parseInt($(".site-header-cart .cart-contents .count").text()) !== 0) {
		$(".site-header-cart .cart-contents .count").show();
	}
	
	var windowWidth = $(window).width();
	if(windowWidth > 768){
		 $( window ).on( 'load resize', function () {
		 });	
	}

	//Adding padding top for header to match with custom header
	var windowWidth = $(window).width();
	if(windowWidth >= 1200){
		$( window ).on( 'load resize', function () {
			if( $( 'body' ).hasClass( 'has-header-media' ) || $( 'body' ).hasClass( 'absolute-header' )) {
				headerheight = $('#masthead').height();
				$('.absolute-header #masthead + .custom-header, .absolute-header #masthead + #feature-slider-section .slider-image-wrapper').css('padding-top', headerheight );
			}
		});
	} else {
		$('.absolute-header #masthead + .custom-header, .absolute-header #masthead + #feature-slider-section .slider-image-wrapper').removeAttr('style');
	}

	//Masonry blocks
	$blocks = $('.grid');

	$blocks.imagesLoaded(function(){
		$blocks.masonry({
			itemSelector: '.grid-item',
			columnWidth: '.grid-item',
			// slow transitions
			transitionDuration: '1s',
			percentPosition: true
		});

	$('#collection-content-section .grid').masonry({
			itemSelector: '.grid-item',
			columnWidth: '.grid-sizer',
			// slow transitions
			transitionDuration: '1s',
			percentPosition: true
		});

		// Fade blocks in after images are ready (prevents jumping and re-rendering)
		$('.grid-item').fadeIn();
		$blocks.find( '.grid-item' ).animate( {
			'opacity' : 1
		} );

	});

	$(window).on( 'load resize', function() {
		var thumbHeight = $('#featured-video-section .featured').height();
		if ( $(window).width() > 1024 ) {
			$('#featured-video-section .side-posts-wrap').css('height', thumbHeight);
		} else {
			$('#featured-video-section .side-post-wrap').removeAttr('style');
		}
	

		var thumbHeight = $('#featured-video-section .featured .video-thumbnail').height();
		$('#featured-video-section .side-posts-wrap').css('height', thumbHeight);
	});


} )( jQuery );
