<?php
/**
 * This file includes the customizer sections files or sub files.
 *
 *
 * @subpackage inc/customizer
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'wen_travel_register_option' ) ) {
	return;
}

if ( ! function_exists( 'wen_travel_wp_travel_get_theme_option' ) ) {

	/**
	 * Provides the customizer theme options.
	 * Returns default options if nothing is set by the user.
	 *
	 * @param string $section_id Customizer section ID.
	 * @param string $control Control key for the section ID..
	 */
	function wen_travel_wp_travel_get_theme_option( $section_id, $control ) {
		if ( ! $section_id || ! $control ) {
			return;
		}

		$default = wen_travel_wp_travel_get_theme_option_defaults( $section_id, $control );
		$options = get_theme_mod( 'wen_travel_wp_travel_options' );
		return ! empty( $options[ $section_id ][ $control ] ) ? $options[ $section_id ][ $control ] : $default;
	}
}

if ( ! function_exists( 'wen_travel_wp_travel_get_wp_travel_taxonomies' ) ) {

	/**
	 * Provides the formatted array for taxonomy listing.
	 */
	function wen_travel_wp_travel_get_wp_travel_taxonomies() {

		$taxonomies = array(
			'mixed'            => esc_html__( 'Mixed', 'wen-travel' ),
			'travel_locations' => esc_html__( 'Trip Locations', 'wen-travel' ),
			'itinerary_types'  => esc_html__( 'Trip Types', 'wen-travel' ),
			'activity'         => esc_html__( 'Trip Activities', 'wen-travel' ),
		);

		return $taxonomies;
	}
}

if ( ! function_exists( 'wen_travel_wp_travel_active_callback_travel_locations' ) ) {

	/**
	 * Active callback function.
	 */
	function wen_travel_wp_travel_active_callback_travel_locations() {
		$selected_tax = get_theme_mod( 'wen_travel_wp_travel_latest_trips_tax_dropdown', 'mixed' );
		return ( 'travel_locations' === $selected_tax );
	}
}

if ( ! function_exists( 'wen_travel_wp_travel_active_callback_itinerary_types' ) ) {

	/**
	 * Active callback function.
	 */
	function wen_travel_wp_travel_active_callback_itinerary_types() {
		$selected_tax = get_theme_mod( 'wen_travel_wp_travel_latest_trips_tax_dropdown', 'mixed' );
		return ( 'itinerary_types' === $selected_tax );
	}
}

if ( ! function_exists( 'wen_travel_wp_travel_active_callback_activity' ) ) {

	/**
	 * Active callback function.
	 */
	function wen_travel_wp_travel_active_callback_activity() {
		$selected_tax = get_theme_mod( 'wen_travel_wp_travel_latest_trips_tax_dropdown', 'mixed' );
		return ( 'activity' === $selected_tax );
	}
}

if ( ! function_exists( 'wen_travel_wp_travel_get_wp_travel_terms' ) ) {
	/**
	 * Provides the customizer formated terms.
	 */
	function wen_travel_wp_travel_get_wp_travel_terms( $taxonomy ) {

		$term_array = array();
		$terms      = get_terms(
			array(
				'taxonomy'   => $taxonomy,
				'hide_empty' => true,
			)
		);

		if ( is_array( $terms ) && count( $terms ) > 0 ) {
			foreach ( $terms as $itinerary_term ) {
				$slug  = ! empty( $itinerary_term->slug ) ? $itinerary_term->slug : '';
				$label = ! empty( $itinerary_term->name ) ? $itinerary_term->name : '';

				$term_array[ $slug ] = $label;
			}
		}

		return $term_array;
	}
}

if ( ! function_exists( 'wen_travel_wp_travel_add_header_items_sortable_section' ) ) {
	/**
	 * Provides the customizer formated terms.
	 */
	function wen_travel_wp_travel_add_header_items_sortable_section( $items ) {
		$items['trip-filter'] = array(
			'label'         => esc_html__( 'WP Travel: Trip Filter', 'wen-travel' ),
			'section'       => 'wen_travel_wp_travel_trip_filter',
			'template-part' => 'third-party/wp-travel/template-parts/trip-filter',
		);

		$items['latest-trips'] = array(
			'label'         => esc_html__( 'WP Travel: Latest Trips', 'wen-travel' ),
			'section'       => 'wen_travel_wp_travel_latest_trips',
			'template-part' => 'third-party/wp-travel/template-parts/latest-trips',
		);

		$items['featured-trips'] = array(
			'label'         => esc_html__( 'WP Travel: Featured Trips', 'wen-travel' ),
			'section'       => 'wen_travel_wp_travel_featured_trips',
			'template-part' => 'third-party/wp-travel/template-parts/featured-trips',
		);

		return $items;
	}
	add_filter( 'wen_travel_sortable_sections', 'wen_travel_wp_travel_add_header_items_sortable_section', 10, 3 );
}

$third_party_theme_dir = get_parent_theme_file_path();
$customizer_files      = array(
	'trip-filter',
	'latest-trips',
	'featured-trips',
);

foreach ( $customizer_files as $customizer_file ) {
	require_once "{$third_party_theme_dir}/third-party/wp-travel/customizer/{$customizer_file}.php";
}
