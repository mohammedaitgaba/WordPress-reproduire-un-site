/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	api = wp.customize;

	// Site title and description.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	// Header text color without header media background.
	api( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative',
					'color': to
				});
			}
		});
	});

	// Color Scheme color.
	api( 'color_scheme', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'color-scheme-default color-scheme-dark color-scheme-red' );
			$( 'body' ).addClass( 'color-scheme-' + to );
		});
	});
})( jQuery );
