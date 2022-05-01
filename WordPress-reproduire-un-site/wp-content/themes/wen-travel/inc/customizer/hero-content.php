<?php
/**
 * Hero Content Options
 *
 * @package WEN_Travel
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_travel_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'wen_travel_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'wen-travel' ),
			'panel' => 'wen_travel_theme_options',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'choices'           => wen_travel_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'wen-travel' ),
			'section'           => 'wen_travel_hero_content_options',
			'type'              => 'select',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'wen_travel_sanitize_post',
			'active_callback'   => 'wen_travel_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'wen-travel' ),
			'section'           => 'wen_travel_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);
}
add_action( 'customize_register', 'wen_travel_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'wen_travel_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since WEN Travel 1.0
	*/
	function wen_travel_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'wen_travel_hero_content_visibility' )->value();

		return wen_travel_check_section( $enable );
	}
endif;
