<?php
/**
 * Services options
 *
 * @package WEN_Travel
 */

/**
 * Add service content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_travel_service_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    wen_travel_register_option( $wp_customize, array(
            'name'              => 'wen_travel_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Wen_Travel_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Services Options, go %1$shere%2$s', 'wen-travel' ),
                '<a href="javascript:wp.customize.section( \'wen_travel_service\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'wen_travel_service', array(
			'title' => esc_html__( 'Services', 'wen-travel' ),
			'panel' => 'wen_travel_theme_options',
		)
	);

	// Add color scheme setting and control.
	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_service_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'choices'           => wen_travel_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'wen-travel' ),
			'section'           => 'wen_travel_service',
			'type'              => 'select',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_service_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_service_active',
			'label'             => esc_html__( 'Title', 'wen-travel' ),
			'section'           => 'wen_travel_service',
			'type'              => 'text',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_service_description',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_service_active',
			'label'             => esc_html__( 'Description', 'wen-travel' ),
			'section'           => 'wen_travel_service',
			'type'              => 'textarea',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_service_number',
			'default'           => 6,
			'sanitize_callback' => 'wen_travel_sanitize_number_range',
			'active_callback'   => 'wen_travel_is_service_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Services is changed (Max no of Services is 20)', 'wen-travel' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'wen-travel' ),
			'section'           => 'wen_travel_service',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'wen_travel_service_number', 6 );

	//loop for service post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		wen_travel_register_option( $wp_customize, array(
                'name'              => 'wen_travel_service_page_' . $i,
                'sanitize_callback' => 'wen_travel_sanitize_post',
                'active_callback'   => 'wen_travel_is_service_active',
                'label'             => esc_html__( 'Page', 'wen-travel' ) . ' ' . $i ,
                'section'           => 'wen_travel_service',
                'type'              => 'dropdown-pages',
                'allow_addition'    => true,
            )
        );
	} // End for().

}
add_action( 'customize_register', 'wen_travel_service_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'wen_travel_is_service_active' ) ) :
	/**
	* Return true if service content is active
	*
	* @since Wen Travel 1.0
	*/
	function wen_travel_is_service_active( $control ) {
		$enable = $control->manager->get_setting( 'wen_travel_service_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return wen_travel_check_section( $enable );
	}
endif;
