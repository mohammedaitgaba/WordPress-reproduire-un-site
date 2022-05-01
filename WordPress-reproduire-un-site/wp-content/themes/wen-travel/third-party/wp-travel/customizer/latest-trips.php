<?php
/**
 * This file provides the section and controls for the frontpage section Latest Trips.
 *
 *
 * @subpackage ./inc/customizer
 */

if ( ! function_exists( 'wen_travel_wp_travel_customizer_latest_trips' ) ) {

	/**
	 * Option functions for the customizer latest trips section.
	 *
	 * @param object $wp_customize WP Customizer object.
	 */
	function wen_travel_wp_travel_customizer_latest_trips( $wp_customize ) {
		$wp_customize->add_section(
			'wen_travel_wp_travel_latest_trips',
			array(
				'panel' => 'wen_travel_theme_options',
				'title' => esc_html__( 'WP Travel: Latest Trips', 'wen-travel' ),
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => 'wen_travel_wp_travel_latest_trips_enable_on',
				'default'           => 'disabled',
				'sanitize_callback' => 'wen_travel_sanitize_select',
				'choices'           => wen_travel_section_visibility_options(),
				'label'             => esc_html__( 'Enable on', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_latest_trips',
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'text',
				'name'              => 'wen_travel_wp_travel_latest_trips_title',
				'default'           => esc_html__( 'Latest Trips', 'wen-travel' ),
				'sanitize_callback' => 'wp_kses_post',
				'label'             => esc_html__( 'Title', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_latest_trips',
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => 'wen_travel_wp_travel_latest_trips_tax_dropdown',
				'default'           => 'mixed',
				'sanitize_callback' => 'wen_travel_sanitize_select',
				'choices'           => wen_travel_wp_travel_get_wp_travel_taxonomies(),
				'label'             => esc_html__( 'Taxonomy Dropdown', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_latest_trips',
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => 'wen_travel_wp_travel_latest_trips_travel_locations_terms',
				'sanitize_callback' => 'wen_travel_sanitize_select',
				'choices'           => wen_travel_wp_travel_get_wp_travel_terms( 'travel_locations' ),
				'label'             => esc_html__( 'Trip Locations', 'wen-travel' ),
				'active_callback'   => 'wen_travel_wp_travel_active_callback_travel_locations',
				'section'           => 'wen_travel_wp_travel_latest_trips',
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => 'wen_travel_wp_travel_latest_trips_itinerary_types_terms',
				'sanitize_callback' => 'wen_travel_sanitize_select',
				'choices'           => wen_travel_wp_travel_get_wp_travel_terms( 'itinerary_types' ),
				'label'             => esc_html__( 'Trip Types', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_latest_trips',
				'active_callback'   => 'wen_travel_wp_travel_active_callback_itinerary_types',
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => 'wen_travel_wp_travel_latest_trips_activity_terms',
				'sanitize_callback' => 'wen_travel_sanitize_select',
				'choices'           => wen_travel_wp_travel_get_wp_travel_terms( 'activity' ),
				'label'             => esc_html__( 'Trip Activities', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_latest_trips',
				'active_callback'   => 'wen_travel_wp_travel_active_callback_activity',
			)
		);

	}
	add_action( 'customize_register', 'wen_travel_wp_travel_customizer_latest_trips' );
}


