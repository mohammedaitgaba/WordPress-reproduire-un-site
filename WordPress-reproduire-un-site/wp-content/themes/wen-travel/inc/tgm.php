<?php
/**
 * TGM implementation.
 *
 * @package WEN_Travel
 */

/**
 * Load TGMPA
 */
require get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'wen_travel_register_recommended_plugins' );

/**
 * Register recommended plugins.
 *
 * @since 1.0.0
 */
function wen_travel_register_recommended_plugins() {

	$plugins = array(
		array(
			'name'     => esc_html__( 'WP Travel', 'wen-travel' ),
			'slug'     => 'wp-travel',
		),
		array(
			'name' => esc_html__( 'Contact Form 7', 'wen-travel' ),
			'slug' => 'contact-form-7',
		),
		array(
			'name' => esc_html__( 'WEN Featured Image', 'wen-travel' ),
			'slug' => 'wen-featured-image',
		),
		array(
			'name' => esc_html__( 'Catch Themes Demo Import', 'wen-travel' ),
			'slug' => 'catch-themes-demo-import',
		),
	);

	// TGM configurations.
	$config = array(
	);

	// Register now.
	tgmpa( $plugins, $config );

}
