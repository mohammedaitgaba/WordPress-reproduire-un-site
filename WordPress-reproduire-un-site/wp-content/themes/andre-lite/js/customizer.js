/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	"use strict";
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( 'a h1.site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( 'h2.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( 'a h1.site-title, h2.site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( 'a h1.site-title, h2.site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	wp.customize( 'carousel_title', function( value ) {
		value.bind( function( to ) {
			$( 'h2.carousel-title' ).text( to );
		} );
	} );
  wp.customize( 'featured_title', function( value ) {
		value.bind( function( to ) {
			$( 'h2.featured-title' ).text( to );
		} );
	} );
} )( jQuery );
