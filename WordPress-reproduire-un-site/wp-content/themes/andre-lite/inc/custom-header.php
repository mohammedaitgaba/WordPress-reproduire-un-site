<?php
/**
 * Custom Header
 *
 * @package andre
 */

/**
 * Setup the WordPress core custom header feature.
 */
function andre_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'andre_custom_header_args',
			array(
				'width'              => 700,
				'height'             => 832,
				'uploads'            => true,
				'default-text-color' => 'cccccc',
				'wp-head-callback'   => 'andre_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'andre_custom_header_setup' );

if ( ! function_exists( 'andre_header_style' ) ) :
	/**
	 * Style for site title and tagline.
	 */
	function andre_header_style() {
		wp_enqueue_style( 'andre-style', get_stylesheet_uri(), array(), '1.0' );
		$header_text_color = get_header_textcolor();
		$position          = 'absolute';
		$clip              = 'rect(1px, 1px, 1px, 1px)';
		if ( ! display_header_text() ) {
			$custom_css = 'a h1.site-title, h2.site-description {
				position: ' . $position . ';
				clip: ' . $clip . ';
			}';
		} else {
			$custom_css = 'h1.site-title, h2.site-description  {
				color: #' . esc_attr( $header_text_color ) . ';
			}';
		}
		wp_add_inline_style( 'andre-style', $custom_css );
	}
	add_action( 'wp_enqueue_scripts', 'andre_header_style' );

endif;
