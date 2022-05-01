<?php
/**
 * Featured Content options
 *
 * @package WEN_Travel
 */

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_travel_featured_content_options( $wp_customize ) {
	// Add note to ECT Featured Content Section
    wen_travel_register_option( $wp_customize, array(
            'name'              => 'wen_travel_featured_content_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Wen_Travel_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Featured Content Options for WEN Travel Theme, go %1$shere%2$s', 'wen-travel' ),
                '<a href="javascript:wp.customize.section( \'wen_travel_featured_content\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'wen_travel_featured_content', array(
			'title' => esc_html__( 'Featured Content', 'wen-travel' ),
			'panel' => 'wen_travel_theme_options',
		)
	);

	// Add color scheme setting and control.
	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_featured_content_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'choices'           => wen_travel_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'wen-travel' ),
			'section'           => 'wen_travel_featured_content',
			'type'              => 'select',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_featured_content_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_featured_content_active',
			'label'             => esc_html__( 'Title', 'wen-travel' ),
			'section'           => 'wen_travel_featured_content',
			'type'              => 'text',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_featured_content_description',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_featured_content_active',
			'label'             => esc_html__( 'Description', 'wen-travel' ),
			'section'           => 'wen_travel_featured_content',
			'type'              => 'textarea',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_featured_content_number',
			'default'           => 3,
			'sanitize_callback' => 'wen_travel_sanitize_number_range',
			'active_callback'   => 'wen_travel_is_featured_content_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Featured Content is changed (Max no of Featured Content is 20)', 'wen-travel' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Featured Content', 'wen-travel' ),
			'section'           => 'wen_travel_featured_content',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'wen_travel_featured_content_number', 3 );

	//loop for featured post content
	for ( $i = 1; $i <= $number ; $i++ ) {

				wen_travel_register_option( $wp_customize, array(
				'name'              => 'wen_travel_featured_content_page_' . $i,
				'sanitize_callback' => 'wen_travel_sanitize_post',
				'active_callback'   => 'wen_travel_is_featured_content_active',
				'label'             => esc_html__( 'Page', 'wen-travel' ) . ' ' . $i ,
				'section'           => 'wen_travel_featured_content',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'wen_travel_featured_content_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'wen_travel_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since Wen Travel 1.0
	*/
	function wen_travel_is_featured_content_active( $control ) {
		$enable = $control->manager->get_setting( 'wen_travel_featured_content_option' )->value();

		return wen_travel_check_section( $enable );
	}
endif;
