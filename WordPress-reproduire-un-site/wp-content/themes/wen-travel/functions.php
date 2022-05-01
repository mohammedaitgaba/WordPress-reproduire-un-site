<?php
/**
 * WEN Travel functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WEN_Travel
 */

if ( ! function_exists( 'wen_travel_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wen_travel_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on WEN Travel, use a find and replace
		 * to change 'wen-travel' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wen-travel', get_parent_theme_file_path( '/languages' ) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
		 *
		 * Google fonts url addition
		 *
		 * Font Awesome addition
		 */
		add_editor_style( array(
			'/css/editor-style.css',
			wen_travel_fonts_url(),
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Used in Portfolio
		set_post_thumbnail_size( 508, 508, true ); // Ratio 1:1

		// Used in Archive: Excerpt image
		add_image_size( 'wen-travel-archive', 508, 381, true ); // Ratio 4:3

		// Used in featured slider
		add_image_size( 'wen-travel-slider', 1920, 1080, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1'        => esc_html__( 'Primary', 'wen-travel' ),
			'social-menu'   => esc_html__( 'Header Social', 'wen-travel' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'wen-travel' ),
					'shortName' => esc_html__( 'S', 'wen-travel' ),
					'size'      => 13,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'wen-travel' ),
					'shortName' => esc_html__( 'M', 'wen-travel' ),
					'size'      => 18,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'wen-travel' ),
					'shortName' => esc_html__( 'L', 'wen-travel' ),
					'size'      => 42,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'wen-travel' ),
					'shortName' => esc_html__( 'XL', 'wen-travel' ),
					'size'      => 56,
					'slug'      => 'huge',
				),
			)
		);

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'White', 'wen-travel' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Black', 'wen-travel' ),
				'slug'  => 'black',
				'color' => '#333',
			),
			array(
				'name'  => esc_html__( 'Gray', 'wen-travel' ),
				'slug'  => 'gray',
				'color' => '#444444',
			),
			array(
				'name'  => esc_html__( 'Medium Gray', 'wen-travel' ),
				'slug'  => 'medium-gray',
				'color' => '#7b7b7b',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'wen-travel' ),
				'slug'  => 'light-gray',
				'color' => '#f6f6f6',
			),
			array(
				'name'  => esc_html__( 'Light Red', 'wen-travel' ),
				'slug'  => 'light-red',
				'color' => '#fa6742',
			),
		) );
	}
endif;
add_action( 'after_setup_theme', 'wen_travel_setup' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 */
function wen_travel_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class ) {
		echo 'class="widget-area footer-widget-area ' . esc_attr( $class ) . '"';
	}
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wen_travel_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wen_travel_content_width', 920 );
}
add_action( 'after_setup_theme', 'wen_travel_content_width', 0 );

if ( ! function_exists( 'wen_travel_template_redirect' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
	 *
	 * @global int $content_width
	 */
	function wen_travel_template_redirect() {
		$layout = wen_travel_get_theme_layout();

		if ( 'no-sidebar-full-width' === $layout ) {
			$GLOBALS['content_width'] = 1510;
		}
	}
endif;
add_action( 'template_redirect', 'wen_travel_template_redirect' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wen_travel_widgets_init() {
	$args = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s"> <div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Sidebar', 'wen-travel' ),
		'id'          => 'sidebar-1',
		'description' => esc_html__( 'Add widgets here.', 'wen-travel' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 1', 'wen-travel' ),
		'id'          => 'sidebar-2',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'wen-travel' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 2', 'wen-travel' ),
		'id'          => 'sidebar-3',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'wen-travel' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 3', 'wen-travel' ),
		'id'          => 'sidebar-4',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'wen-travel' ),
		) + $args
	);
}
add_action( 'widgets_init', 'wen_travel_widgets_init' );

if ( ! function_exists( 'wen_travel_fonts_url' ) ) :
	/**
	 * Register Google fonts for Wen Travel
	 *
	 * Create your own wen_travel_fonts_url() function to override in a child theme.
	 *
	 * @since 1.0.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function wen_travel_fonts_url() {
		$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Open Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$open_sans = _x( 'on', 'Open Sans: on or off', 'wen-travel' );

	/* Translators: If there are characters in your language that are not
	* supported by Lora, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$lora = _x( 'on', 'Lora font: on or off', 'wen-travel' );

	/* Translators: If there are characters in your language that are not
	* supported by Alegreya Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$alegreya_sans = _x( 'on', 'Alegreya Sans font: on or off', 'wen-travel' );

	if ( 'off' !== $open_sans || 'off' !== $lora || 'off' !== $alegreya_sans ) {
		$font_families = array();

		if ( 'off' !== $open_sans ) {
		$font_families[] = 'Open Sans:300,400,500,600,700,400italic,700italic';
		}

		if ( 'off' !== $lora ) {
		$font_families[] = 'Lora:300,400,500,600,700,400italic,700italic';
		}

		if ( 'off' !== $alegreya_sans ) {
		$font_families[] = 'Alegreya Sans';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since WEN Travel 1.0
 */
function wen_travel_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'wen_travel_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function wen_travel_scripts() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'wen-travel-fonts', wen_travel_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'wen-travel-style', get_stylesheet_uri(), null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );

	// Theme block stylesheet.
	wp_enqueue_style( 'wen-travel-block-style', get_theme_file_uri( '//css/blocks.css' ), array( 'wen-travel-style' ), date( 'Ymd-Gis', filemtime( get_template_directory() . '//css/blocks.css' ) ) );

	// Load the html5 shiv.
	wp_enqueue_script( 'wen-travel-html5',  get_theme_file_uri() . 'js/html5' . $min . '.js', array(), '3.7.3' );

	wp_script_add_data( 'wen-travel-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'wen-travel-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/skip-link-focus-fix' . $min . '.js', array(), '201800703', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$deps[] = 'jquery';

	//Slider Scripts
	$enable_slider             = wen_travel_check_section( get_theme_mod( 'wen_travel_slider_option', 'disabled' ) );
	$enable_testimonial_slider = wen_travel_check_section( get_theme_mod( 'wen_travel_testimonial_option', 'disabled' ) );

	if ( $enable_slider || $enable_testimonial_slider ) {
		// Enqueue owl carousel css. Must load CSS before JS.
		wp_enqueue_style( 'owl-carousel-core', get_theme_file_uri( '/css/owl-carousel/owl.carousel.min.css' ), null, '2.3.4' );
		wp_enqueue_style( 'owl-carousel-default', get_theme_file_uri( '/css/owl-carousel/owl.theme.default.min.css' ), null, '2.3.4' );

		// Enqueue script
		wp_enqueue_script( 'owl-carousel', get_theme_file_uri( 'js/owl.carousel' . $min . '.js'), array( 'jquery' ), '2.3.4', true );

		$deps[] = 'owl-carousel';

	}

	// Add masonry to dependent scripts of main script.
	$deps[] = 'jquery-masonry';

	wp_enqueue_script( 'wen-travel-script', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/functions' . $min . '.js', $deps, date( 'Ymd-Gis', filemtime( get_template_directory() . '/' . 'js/functions' . $min . '.js' ) ), true );

	wp_localize_script( 'wen-travel-script', 'wenTravelOptions', array(
		'screenReaderText' => array(
			'expand'   => esc_html__( 'expand child menu', 'wen-travel' ),
			'collapse' => esc_html__( 'collapse child menu', 'wen-travel' ),
			'icon'     => wen_travel_get_svg( array(
					'icon'     => 'angle-down',
					'fallback' => true,
				)
			),
		),
		'iconNavPrev'     => wen_travel_get_svg( array(
				'icon'     => 'angle-left',
				'fallback' => true,
			)
		),
		'iconNavNext'     => wen_travel_get_svg( array(
				'icon'     => 'angle-right',
				'fallback' => true,
			)
		),
		'rtl' => is_rtl(),
	) );
}
add_action( 'wp_enqueue_scripts', 'wen_travel_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 */
function wen_travel_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'wen-travel-block-editor-style', get_theme_file_uri( '/css/editor-blocks.css' ) );

	// Add custom fonts.
	wp_enqueue_style( 'wen-travel-fonts', wen_travel_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'wen_travel_block_editor_styles' );

if ( ! function_exists( 'wen_travel_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since WEN Travel 1.0
	 */
	function wen_travel_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$length	= get_theme_mod( 'wen_travel_excerpt_length', 20 );

		return absint( $length );
	}
endif; //wen_travel_excerpt_length
add_filter( 'excerpt_length', 'wen_travel_excerpt_length', 999 );

if ( ! function_exists( 'wen_travel_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
	 *
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function wen_travel_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text = get_theme_mod( 'wen_travel_excerpt_more_text',  esc_html__( 'Continue reading', 'wen-travel' ) );

		$link = sprintf( '<p><a href="%1$s" class="more-link">%2$s</a></p>',
			esc_url( get_permalink() ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
		);

		if ( 'itineraries' === get_post_type() ) {
			$link = '';
		}

		return $link;
	}
endif;
add_filter( 'excerpt_more', 'wen_travel_excerpt_more' );

if ( ! function_exists( 'wen_travel_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since WEN Travel 1.0
	 */
	function wen_travel_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = get_theme_mod( 'wen_travel_excerpt_more_text', esc_html__( 'Continue reading', 'wen-travel' ) );

			$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
				esc_url( get_permalink() ),
				/* translators: %s: Name of current post */
				wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

			if ( 'itineraries' === get_post_type() ) {
				$link = '';
			}

			$output .= $link;
		}

		return $output;
	}
endif; //wen_travel_custom_excerpt
add_filter( 'get_the_excerpt', 'wen_travel_custom_excerpt' );

if ( ! function_exists( 'wen_travel_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since WEN Travel 1.0
	 */
	function wen_travel_more_link( $more_link, $more_link_text ) {
		$more_tag_text = get_theme_mod( 'wen_travel_excerpt_more_text', esc_html__( 'Continue reading', 'wen-travel' ) );

		return ' &hellip; ' . str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
	}
endif; //wen_travel_more_link
add_filter( 'the_content_more_link', 'wen_travel_more_link', 10, 2 );

/**
 * Load TGMPA
 */
require_once get_parent_theme_file_path( '/inc/tgm.php' );

/**
 * Implement the Custom Header feature
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions
 */
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Color Scheme additions
 */
require get_parent_theme_file_path( '/inc/color-scheme.php' );

/**
 * Load Jetpack compatibility file
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_parent_theme_file_path( '/inc/jetpack.php' );
}

/**
 * Load TGMPA
 */
require get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );

/**
 * Load Theme About Page
 */
require get_parent_theme_file_path( '/inc/admin/admin.php' );

/**
 * Load WP Travel Support
 */
require get_parent_theme_file_path( '/third-party/wp-travel/functions.php' );

/**
 * Load Icon functions
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );
