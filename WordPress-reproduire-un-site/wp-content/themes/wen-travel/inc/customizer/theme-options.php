<?php
/**
 * Theme Options
 *
 * @package WEN_Travel
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_travel_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'wen_travel_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'wen-travel' ),
		'priority' => 130,
	) );

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_latest_posts_title',
			'default'           => esc_html__( 'News', 'wen-travel' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Latest Posts Title', 'wen-travel' ),
			'section'           => 'wen_travel_theme_options',
		)
	);

	// Footer Options.
	$wp_customize->add_section( 'wen_travel_footer_options', array(
		'title'       => esc_html__( 'Footer Options', 'wen-travel' ),
		'description' => esc_html__( 'You can either add html or plain text or custom shortcodes, which will be automatically inserted into your theme. Some shorcodes: [the-year], [site-link] and [privacy-policy-link] for current year, site link and privacy policy link respectively.', 'wen-travel' ),
		'panel'       => 'wen_travel_theme_options',
	) );

	$theme_data = wp_get_theme();

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_footer_copyright_text',
			'default'           => sprintf( _x( 'Copyright &copy; %1$s %2$s %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'wen-travel' ), '[the-year]', '[site-link]', '[privacy-policy-link]' ) . '<span class="sep"> | </span>',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Copyright Text', 'wen-travel' ),
			'section'           => 'wen_travel_footer_options',
			'type'              => 'textarea',
		)
	);

	// Layout Options
	$wp_customize->add_section( 'wen_travel_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'wen-travel' ),
		'panel' => 'wen_travel_theme_options',
		)
	);

	/* Default Layout */
	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'wen-travel' ),
			'section'           => 'wen_travel_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'wen-travel' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'wen-travel' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_homepage_archive_layout',
			'default'           => 'no-sidebar-full-width',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'wen-travel' ),
			'section'           => 'wen_travel_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'wen-travel' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'wen-travel' ),
			),
		)
	);

	/* Single Page/Post Image */
	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image', 'wen-travel' ),
			'section'           => 'wen_travel_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'disabled'              => esc_html__( 'Disabled', 'wen-travel' ),
				'post-thumbnail'        => esc_html__( 'Post Thumbnail', 'wen-travel' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'wen_travel_excerpt_options', array(
		'panel'     => 'wen_travel_theme_options',
		'title'     => esc_html__( 'Excerpt Options', 'wen-travel' ),
	) );

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_excerpt_length',
			'default'           => '20',
			'sanitize_callback' => 'absint',
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'wen-travel' ),
			'section'  => 'wen_travel_excerpt_options',
			'type'     => 'number',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading...', 'wen-travel' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'wen-travel' ),
			'section'           => 'wen_travel_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'wen_travel_search_options', array(
		'panel'     => 'wen_travel_theme_options',
		'title'     => esc_html__( 'Search Options', 'wen-travel' ),
	) );

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_search_text',
			'default'           => esc_html__( 'Search', 'wen-travel' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Search Text', 'wen-travel' ),
			'section'           => 'wen_travel_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'wen_travel_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'wen-travel' ),
		'panel'       => 'wen_travel_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'wen-travel' ),
	) );
	
	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'News', 'wen-travel' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'wen-travel' ),
			'section'           => 'wen_travel_homepage_options',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_front_page_category',
			'sanitize_callback' => 'wen_travel_sanitize_category_list',
			'custom_control'    => 'Wen_Travel_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'wen-travel' ),
			'section'           => 'wen_travel_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'wen_travel_scrollup', array(
		'panel'    => 'wen_travel_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'wen-travel' ),
	) );

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_disable_scrollup',
			'default'			=> 1,
			'sanitize_callback' => 'wen_travel_sanitize_checkbox',
			'label'             => esc_html__( 'Scroll Up', 'wen-travel' ),
			'section'           => 'wen_travel_scrollup',
			'custom_control'    => 'Wen_Travel_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'wen_travel_theme_options' );

/** Active Callback Functions */

if ( ! function_exists( 'wen_travel_scroll_plugins_inactive' ) ) :
	/**
	* Return true if infinite scroll functionality exists
	*
	* @since WEN Travel 1.0
	*/
	function wen_travel_scroll_plugins_inactive( $control ) {
		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) ) {
			// Support infinite scroll plugins.
			return false;
		}

		return true;
	}
endif;

if ( ! function_exists( 'wen_travel_is_static_page_enabled' ) ) :
	/**
	* Return true if A Static Page is enabled
	*
	* @since WEN Travel 1.1.2
	*/
	function wen_travel_is_static_page_enabled( $control ) {
		$enable = $control->manager->get_setting( 'show_on_front' )->value();
		if ( 'page' === $enable ) {
			return true;
		}
		return false;
	}
endif;
