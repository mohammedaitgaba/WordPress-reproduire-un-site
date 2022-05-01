<?php
/**
 * This file provides the section and controls for the frontpage section Featured Trips.
 *
 *
 * @subpackage ./inc/customizer
 */

if ( ! function_exists( 'wen_travel_wp_travel_customizer_trip_filter' ) ) {

	/**
	 * Option functions for the customizer featured trips section.
	 *
	 * @param object $wp_customize WP Customizer object.
	 */
	function wen_travel_wp_travel_customizer_trip_filter( $wp_customize ) {
		$wp_customize->add_section(
			'wen_travel_wp_travel_trip_filter',
			array(
				'panel' => 'wen_travel_theme_options',
				'title' => esc_html__( 'WP Travel: Trip Filter', 'wen-travel' ),
			)
		);

		wen_travel_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => 'wen_travel_wp_travel_trip_filter_enable_on',
				'default'           => 'disabled',
				'sanitize_callback' => 'wen_travel_sanitize_select',
				'choices'           => wen_travel_section_visibility_options(),
				'label'             => esc_html__( 'Enable on', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_trip_filter',
				'priority'          => 1,
			)
		);

		wen_travel_register_option( 
			$wp_customize, 
			array(
				'name'              => 'wen_travel_wp_travel_trip_filter_main_image',
				'custom_control'    => 'WP_Customize_Image_Control',
				'sanitize_callback' => 'wen_travel_sanitize_image',
				'label'             => esc_html__( 'Main Image', 'wen-travel' ),
				'section'           => 'wen_travel_wp_travel_trip_filter',
            )
        );

        wen_travel_register_option( $wp_customize, array(
                'name'              => 'wen_travel_wp_travel_trip_filter_enable_locations',
                'sanitize_callback' => 'wen_travel_sanitize_checkbox',
                'label'             => esc_html__( 'Location', 'wen-travel' ),
                'default'           => 1,
                'section'           => 'wen_travel_wp_travel_trip_filter',
                'custom_control'    => 'Wen_Travel_Toggle_Control',
            )
        );

        wen_travel_register_option( $wp_customize, array(
                'name'              => 'wen_travel_wp_travel_trip_filter_enable_itinerary',
                'sanitize_callback' => 'wen_travel_sanitize_checkbox',
                'label'             => esc_html__( 'Itinerary', 'wen-travel' ),
                'default'           => 1,
                'section'           => 'wen_travel_wp_travel_trip_filter',
                'custom_control'    => 'Wen_Travel_Toggle_Control',
            )
        );

        wen_travel_register_option( $wp_customize, array(
                'name'              => 'wen_travel_wp_travel_trip_filter_keyword',
                'sanitize_callback' => 'sanitize_text_field',
                'label'             => esc_html__( 'Keyword Text', 'wen-travel' ),
                'default'           => esc_html__( 'Keyword', 'wen-travel' ),
                'section'           => 'wen_travel_wp_travel_trip_filter',
                'type'              => 'text',
            )
        );
	}
	add_action( 'customize_register', 'wen_travel_wp_travel_customizer_trip_filter' );

}
