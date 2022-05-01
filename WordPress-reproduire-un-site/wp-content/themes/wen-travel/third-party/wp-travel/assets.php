<?php
/**
 * This files handles the enqueuing of the necessary styles and scripts.
 *
 * @package WEN_Travel
 * @subpackage WP_Travel
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'wen_travel_wp_travel_enqueue_styles_and_scripts' ) ) {

	/**
	 * Enqueue the registered styles and scripts.
	 */
	function wen_travel_wp_travel_enqueue_styles_and_scripts() {
		wen_travel_wp_travel_enqueue_styles();

		wen_travel_wp_travel_enqueue_scripts();

	}
	add_action( 'wp_enqueue_scripts', 'wen_travel_wp_travel_enqueue_styles_and_scripts' );
}

if ( ! function_exists( 'wen_travel_wp_travel_enqueue_styles' ) ) {

	/**
	 * Enqueue all stylesheets.
	 *
	 * @param array $args Required arguments for theme.
	 */
	function wen_travel_wp_travel_enqueue_styles() {
		$css_files = array(
			'wen-travel-wp-travel-main-style'              => 'main', // handle => file-name
			'wen-travel-wp-travel-archive-itinerary-style' => 'archive-itinerary',
		);

		/**
		 * Only load this style if it is single itineray page or trip booking page
		 */
		if ( is_single() && 'itineraries' === get_post_type() ) {
			$css_files['wen-travel-wp-travel-single-itinerary-style'] = 'single-itinerary';
		}

		foreach ( $css_files as $index => $css ) {
			$file     = "third-party/wp-travel/assets/css/{$css}.css";
			$file_url = get_theme_file_uri( $file );
			$version  = date( 'Ymd-Gis', filemtime( trailingslashit ( get_template_directory() ) . $file ) );

			wp_enqueue_style( $index, $file_url, array( 'wen-travel-style' ), $version );
		}
	}
}


if ( ! function_exists( 'wen_travel_wp_travel_enqueue_scripts' ) ) {

	/**
	 * Enqueue all scripts.
	 *
	 * @param array $args Required arguments for theme.
	 */
	function wen_travel_wp_travel_enqueue_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		$file     = "third-party/wp-travel/assets/js/custom{$suffix}.js";
		$file_url = get_theme_file_uri( $file );
		$version  = date( 'Ymd-Gis', filemtime( trailingslashit ( get_template_directory() ) . $file ) );

		wp_enqueue_style( 'owl-carousel-core', get_theme_file_uri( '/css/owl-carousel/owl.carousel.min.css' ), null, '2.3.4' );
		wp_enqueue_style( 'owl-carousel-default', get_theme_file_uri( '/css/owl-carousel/owl.theme.default.min.css' ), null, '2.3.4' );
		wp_enqueue_script( 'owl-carousel', get_theme_file_uri( '/js/owl.carousel.min.js' ), array( 'jquery' ), '2.3.4', true );

		wp_enqueue_script( 'wen-travel-wp-travel-script', $file_url, array( 'jquery', 'owl-carousel' ), $version, true );
	}
}
