<?php
/**
 * This file provides the section and controls for the frontpage section Popular Destination.
 *
 *
 * @subpackage ./inc/customizer
 */

if ( ! function_exists( 'wen_travel_wp_travel_customizer_trip_activities' ) ) {

	/**
	 * Option functions for the customizer popular destination section.
	 *
	 * @param object $wp_customize WP Customizer object.
	 */
	function wen_travel_wp_travel_customizer_trip_activities( $wp_customize ) {
		$wp_customize->add_section(
			'wen_travel_wp_travel_trip_activities',
			array(
				'panel' => 'wen_travel_theme_options',
				'title' => esc_html__( 'WP Travel: Trip Activities', 'wen-travel' ),
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => 'wen_travel_wp_travel_trip_activities_enable_on',
				'default'           => 'disabled',
				'sanitize_callback' => 'wen_travel_sanitize_select',
				'choices'           => wen_travel_section_visibility_options(),
				'label'             => esc_html__( 'Enable on', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_trip_activities',
				'priority'          => 1,
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'text',
				'name'              => 'wen_travel_wp_travel_trip_activities_title',
				'default'           => esc_html__( 'Trip Activities', 'wen-travel' ),
				'sanitize_callback' => 'wp_kses_post',
				'label'             => esc_html__( 'Title', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_trip_activities',
			)
		);

		wen_travel_register_option( $wp_customize, array(
                'name'              => 'wen_travel_wp_travel_trip_activities_hide_empty',
                'sanitize_callback' => 'wen_travel_sanitize_checkbox',
                'label'             => esc_html__( 'Hide empty activities?', 'wen-travel' ),
                'default'           => 1,
                'section'           => 'wen_travel_wp_travel_trip_activities',
                'custom_control'    => 'Wen_Travel_Toggle_Control',
            )
        );

	}
	add_action( 'customize_register', 'wen_travel_wp_travel_customizer_trip_activities' );

}
