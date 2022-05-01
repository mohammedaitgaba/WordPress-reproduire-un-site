<?php
/**
 * Featured Slider Options
 *
 * @package WEN_Travel
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_travel_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'wen_travel_featured_slider', array(
			'panel' => 'wen_travel_theme_options',
			'title' => esc_html__( 'Featured Slider', 'wen-travel' ),
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'choices'           => wen_travel_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'wen-travel' ),
			'section'           => 'wen_travel_featured_slider',
			'type'              => 'select',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'wen_travel_sanitize_number_range',

			'active_callback'   => 'wen_travel_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'wen-travel' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'wen-travel' ),
			'section'           => 'wen_travel_featured_slider',
			'type'              => 'number',
		)
	);

	$slider_number = get_theme_mod( 'wen_travel_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {
		// Page Sliders
		wen_travel_register_option( $wp_customize, array(
				'name'              => 'wen_travel_slider_page_' . $i,
				'sanitize_callback' => 'wen_travel_sanitize_post',
				'active_callback'   => 'wen_travel_is_slider_active',
				'label'             => esc_html__( 'Page', 'wen-travel' ) . ' # ' . $i,
				'section'           => 'wen_travel_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);

	} // End for().
}
add_action( 'customize_register', 'wen_travel_slider_options' );

/** Active Callback Functions */

if ( ! function_exists( 'wen_travel_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since WEN Travel 1.0
	*/
	function wen_travel_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'wen_travel_slider_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return wen_travel_check_section( $enable );
	}
endif;
