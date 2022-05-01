<?php
/**
 * WP Travel support functions and definitions.
 *
 * @package WEN_Travel
 * @subpackage WP_Travel
 */

if ( ! class_exists( 'WP_Travel' ) ) {
    // Bail if WP Travel plugin is not installed.
    return;
}

$file_paths = array(
	'assets',
	'helpers',
	'customizer/customizer',
);

foreach ( $file_paths as $file_path ) {
	require get_theme_file_path( "/third-party/wp-travel/{$file_path}.php" );
}
