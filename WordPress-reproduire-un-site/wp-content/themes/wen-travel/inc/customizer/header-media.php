<?php
/**
 * Header Media Options
 *
 * @package WEN_Travel
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_travel_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'wen-travel' );

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_header_media_option',
			'default'           => 'entire-site',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'wen-travel' ),
				'entire-site'            => esc_html__( 'Entire Site', 'wen-travel' ),
				'disable'                => esc_html__( 'Disabled', 'wen-travel' ),
			),
			'label'             => esc_html__( 'Enable on', 'wen-travel' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'wen-travel' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Site Header Text', 'wen-travel' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_header_media_url',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'wen-travel' ),
			'section'           => 'header_image',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'wen-travel' ),
			'section'           => 'header_image',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_header_url_target',
			'sanitize_callback' => 'wen_travel_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'wen-travel' ),
			'section'           => 'header_image',
			'custom_control'    => 'Wen_Travel_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'wen_travel_header_media_options' );
