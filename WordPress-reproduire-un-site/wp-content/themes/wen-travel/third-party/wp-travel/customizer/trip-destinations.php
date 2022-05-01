<?php
/**
 * This file provides the section and controls for the frontpage section Popular Destination.
 *
 * @subpackage ./inc/customizer
 */

if ( ! function_exists( 'wen_travel_wp_travel_customizer_trip_destinations' ) ) {

	/**
	 * Option functions for the customizer popular destination section.
	 *
	 * @param object $wp_customize WP Customizer object.
	 */
	function wen_travel_wp_travel_customizer_trip_destinations( $wp_customize ) {
		$wp_customize->add_section(
			'wen_travel_wp_travel_trip_destinations',
			array(
				'panel' => 'wen_travel_theme_options',
				'title' => esc_html__( 'WP Travel: Trip Destinations', 'wen-travel' ),
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => 'wen_travel_wp_travel_trip_destinations_enable_on',
				'default'           => 'disabled',
				'sanitize_callback' => 'wen_travel_sanitize_select',
				'choices'           => wen_travel_section_visibility_options(),
				'label'             => esc_html__( 'Enable on', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_trip_destinations',
				'priority'          => 1,
			)
		);

		wen_travel_register_option( $wp_customize, array(
                'name'              => 'wen_travel_wp_travel_trip_destinations_title',
                'sanitize_callback' => 'sanitize_text_field',
                'label'             => esc_html__( 'Title', 'wen-travel' ),
                'default'           => esc_html__( 'Trip Destinations', 'wen-travel' ),
                'section'           => 'wen_travel_wp_travel_trip_destinations',
                'type'              => 'text',
            )
        );

		wen_travel_register_option( $wp_customize, array(
                'name'              => 'wen_travel_wp_travel_trip_destinations_hide_empty',
                'sanitize_callback' => 'wen_travel_sanitize_checkbox',
                'label'             => esc_html__( 'Hide empty destinations', 'wen-travel' ),
                'default'           => 1,
                'section'           => 'wen_travel_wp_travel_trip_destinations',
                'custom_control'    => 'Wen_Travel_Toggle_Control',
            )
        );
	}
	add_action( 'customize_register', 'wen_travel_wp_travel_customizer_trip_destinations' );

}
