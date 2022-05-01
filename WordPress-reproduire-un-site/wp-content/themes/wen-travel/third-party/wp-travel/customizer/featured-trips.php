<?php
/**
 * This file provides the section and controls for the frontpage section Featured Trips.
 *
 *
 * @subpackage ./inc/customizer
 */

if ( ! function_exists( 'wen_travel_wp_travel_customizer_featured_trips' ) ) {

	/**
	 * Option functions for the customizer featured trips section.
	 *
	 * @param object $wp_customize WP Customizer object.
	 */
	function wen_travel_wp_travel_customizer_featured_trips( $wp_customize ) {
		$wp_customize->add_section(
			'wen_travel_wp_travel_featured_trips',
			array(
				'panel' => 'wen_travel_theme_options',
				'title' => esc_html__( 'WP Travel: Featured Trips', 'wen-travel' ),
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => 'wen_travel_wp_travel_featured_trips_enable_on',
				'default'           => 'disabled',
				'sanitize_callback' => 'wen_travel_sanitize_select',
				'choices'           => wen_travel_section_visibility_options(),
				'label'             => esc_html__( 'Enable on', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_featured_trips',
				'priority'          => 1,
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'text',
				'name'              => 'wen_travel_wp_travel_featured_trips_title',
				'default'           => esc_html__( 'Featured Trips', 'wen-travel' ),
				'sanitize_callback' => 'wp_kses_post',
				'label'             => esc_html__( 'Title', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_featured_trips',
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => 'wen_travel_wp_travel_featured_trips_layout',
				'default'           => 'default',
				'sanitize_callback' => 'wen_travel_sanitize_select',
				'choices'           => array(
					'default' => esc_html__( 'Default View', 'wen-travel' ),
					'grid'    => esc_html__( 'Grid View', 'wen-travel' ),
				),
				'label'             => esc_html__( 'Slider layout', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_featured_trips',
				'priority'          => 1,
			)
		);

	}
	add_action( 'customize_register', 'wen_travel_wp_travel_customizer_featured_trips' );

}
