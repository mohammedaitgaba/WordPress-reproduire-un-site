<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package WEN_Travel
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_travel_testimonial_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_jetpack_testimonial_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Wen_Travel_Note_Control',
			'label'             => sprintf( esc_html__( 'For Testimonial Options for WEN Travel Theme, go %1$shere%2$s', 'wen-travel' ),
				'<a href="javascript:wp.customize.section( \'wen_travel_testimonials\' ).focus();">',
				 '</a>'
			),
		   'section'            => 'jetpack_testimonials',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'wen_travel_testimonials', array(
			'panel'    => 'wen_travel_theme_options',
			'title'    => esc_html__( 'Testimonials', 'wen-travel' ),
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_testimonial_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'choices'           => wen_travel_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'wen-travel' ),
			'section'           => 'wen_travel_testimonials',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_testimonial_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_testimonial_active',
			'label'             => esc_html__( 'Title', 'wen-travel' ),
			'section'           => 'wen_travel_testimonials',
			'type'              => 'text',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_testimonial_description',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_testimonial_active',
			'label'             => esc_html__( 'Description', 'wen-travel' ),
			'section'           => 'wen_travel_testimonials',
			'type'              => 'textarea',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_testimonial_number',
			'default'           => '3',
			'sanitize_callback' => 'wen_travel_sanitize_number_range',
			'active_callback'   => 'wen_travel_is_testimonial_active',
			'label'             => esc_html__( 'Number of items', 'wen-travel' ),
			'section'           => 'wen_travel_testimonials',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'wen_travel_testimonial_number', 3 );

	for ( $i = 1; $i <= $number ; $i++ ) {

		wen_travel_register_option( $wp_customize, array(
				'name'              => 'wen_travel_testimonial_page_' . $i,
				'sanitize_callback' => 'wen_travel_sanitize_post',
				'active_callback'   => 'wen_travel_is_testimonial_active',
				'label'             => esc_html__( 'Page', 'wen-travel' ) . ' ' . $i ,
				'section'           => 'wen_travel_testimonials',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'wen_travel_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'wen_travel_is_testimonial_active' ) ) :
	/**
	* Return true if testimonial is active
	*
	* @since WEN Travel 1.0
	*/
	function wen_travel_is_testimonial_active( $control ) {
		$enable = $control->manager->get_setting( 'wen_travel_testimonial_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return wen_travel_check_section( $enable );
	}
endif;
