<?php
/**
 * Themes functions and definitions
 *
 * @package andre
 */

// This theme requires WordPress 5.6 or later.

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function andre_setup() {
	global $content_width;
	if ( ! isset( $content_width ) ) {
			$content_width = 1600;
	}

	load_theme_textdomain( 'andre-lite', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo' );

	add_theme_support( 'responsive-embeds' );

	add_post_type_support( 'page', 'excerpt' );

	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'align-wide' );

	add_theme_support( 'html5', array( 'gallery', 'caption' ) );

	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name' => esc_html__( 'Small', 'andre-lite' ),
				'size' => 13,
				'slug' => 'small',
			),
			array(
				'name' => esc_html__( 'Regular', 'andre-lite' ),
				'size' => 17,
				'slug' => 'regular',
			),
			array(
				'name' => esc_html__( 'Medium', 'andre-lite' ),
				'size' => 26,
				'slug' => 'medium',
			),
			array(
				'name' => esc_html__( 'Large', 'andre-lite' ),
				'size' => 36,
				'slug' => 'large',
			),
			array(
				'name' => esc_html__( 'Huge', 'andre-lite' ),
				'size' => 50,
				'slug' => 'huge',
			),
		)
	);

	add_theme_support( 'editor-styles' );

	add_editor_style( 'style-editor.css' );
	add_editor_style( andre_roboto_font_url() );

	register_nav_menus(
		array(
			'main-menu' => esc_html__( 'Primary Menu', 'andre-lite' ),
			'social'    => esc_html__( 'Social Menu', 'andre-lite' ),
		)
	);

	add_theme_support(
		'custom-background',
		array(
			'default-color' => '080808',
		)
	);

	add_theme_support( 'post-thumbnails' );
	add_image_size( 'andre-blogthumb', 1300, 9999 );
}
add_action( 'after_setup_theme', 'andre_setup' );

/**
 * Register widget areas.
 */
function andre_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'andre-lite' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Top Widget', 'andre-lite' ),
			'id'            => 'sidebar-2',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'andre_widgets_init' );

/**
 * Register Roboto Fonnt for andre.
 *
 * @return string
 */
function andre_roboto_font_url() {
	$roboto_font_url = '';

	/*
	Translators: If there are characters in your language that are not supported
	by this font, translate this to 'off'. Do not translate into your own language.
	*/
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'andre-lite' ) ) {
		$roboto_font_url = add_query_arg( 'family', rawurlencode( 'Roboto:300,400,500,700,900' ), 'https://fonts.googleapis.com/css' );
	}
	return $roboto_font_url;
}

/**
 * Including theme scripts and styles.
 */
function andre_scripts_styles() {
	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( ! is_admin() ) {
		wp_enqueue_script( 'andre-responsive-videos', get_template_directory_uri() . '/js/responsive-videos.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'andre-animate', get_template_directory_uri() . '/js/animate.js', array( 'jquery' ), '0.1.0', true );
		wp_enqueue_script( 'andre-custom', get_template_directory_uri() . '/js/customscripts.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'andre-roboto', andre_roboto_font_url(), array(), '1.0', null );
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );
		wp_enqueue_style( 'animate-style', get_template_directory_uri() . '/animate.css', array(), '1', 'screen' );
		wp_enqueue_style( 'andre-style', get_stylesheet_uri(), array(), '1.0' );
		wp_style_add_data( 'andre-style', 'rtl', 'replace' );
	}
}
add_action( 'wp_enqueue_scripts', 'andre_scripts_styles' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
