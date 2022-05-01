<?php
/**
 * Add Portfolio Settings in Customizer
 *
 * @package WEN_Travel
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_travel_portfolio_options( $wp_customize ) {
	// Add note to Jetpack Portfolio Section
	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_jetpack_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Wen_Travel_Note_Control',
			'label'             => sprintf( esc_html__( 'For Portfolio Options for WEN Travel Theme, go %1$shere%2$s', 'wen-travel' ),
				 '<a href="javascript:wp.customize.section( \'wen_travel_portfolio\' ).focus();">',
				 '</a>'
			),
			'section'           => 'jetpack_portfolio',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'wen_travel_portfolio', array(
			'panel'    => 'wen_travel_theme_options',
			'title'    => esc_html__( 'Portfolio', 'wen-travel' ),
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_portfolio_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'choices'           => wen_travel_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'wen-travel' ),
			'section'           => 'wen_travel_portfolio',
			'type'              => 'select',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_portfolio_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_portfolio_active',
			'label'             => esc_html__( 'Title', 'wen-travel' ),
			'section'           => 'wen_travel_portfolio',
			'type'              => 'text',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_portfolio_description',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_portfolio_active',
			'label'             => esc_html__( 'Description', 'wen-travel' ),
			'section'           => 'wen_travel_portfolio',
			'type'              => 'textarea',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_portfolio_number',
			'default'           => 3,
			'sanitize_callback' => 'wen_travel_sanitize_number_range',
			'active_callback'   => 'wen_travel_is_portfolio_active',
			'label'             => esc_html__( 'Number of items to show', 'wen-travel' ),
			'section'           => 'wen_travel_portfolio',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'wen_travel_portfolio_number', 3 );

	for ( $i = 1; $i <= $number ; $i++ ) {
		wen_travel_register_option( $wp_customize, array(
				'name'              => 'wen_travel_portfolio_page_' . $i,
				'sanitize_callback' => 'wen_travel_sanitize_post',
				'active_callback'   => 'wen_travel_is_portfolio_active',
				'label'             => esc_html__( 'Page', 'wen-travel' ) . ' ' . $i ,
				'section'           => 'wen_travel_portfolio',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'wen_travel_portfolio_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'wen_travel_is_portfolio_active' ) ) :
	/**
	* Return true if portfolio is active
	*
	* @since WEN Travel 1.0
	*/
	function wen_travel_is_portfolio_active( $control ) {
		$enable = $control->manager->get_setting( 'wen_travel_portfolio_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return wen_travel_check_section( $enable );
	}
endif;
