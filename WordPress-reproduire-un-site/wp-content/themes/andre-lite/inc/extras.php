<?php
/**
 * Extra functions for this theme.
 *
 * @package andre
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function andre_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) ) {
		$args['show_home'] = true;
		return $args;
	}
}
add_filter( 'wp_page_menu_args', 'andre_page_menu_args' );

if ( ! is_admin() ) {
	/**
	 * Defines new blog excerpt length and link text.
	 *
	 * @param array $length Configuration arguments.
	 */
	function andre_new_excerpt_length( $length ) {
		return 70;
	}
	add_filter( 'excerpt_length', 'andre_new_excerpt_length' );

	add_filter( 'the_excerpt', 'andre_read_more_custom_excerpt' );
	/**
	 * Defines new blog excerpt length and link text.
	 *
	 * @param array $text Configuration arguments.
	 */
	function andre_read_more_custom_excerpt( $text ) {
		if ( strpos( $text, '[&hellip;]' ) ) {
				$excerpt = str_replace( '[&hellip;]', '<a class="more-link" href="' . get_permalink() . '">' . __( 'Read More', 'andre-lite' ) . '</a>', $text );
		} else {
			$excerpt = $text . '<a class="more-link" href="' . get_permalink() . '">' . __( 'Read More', 'andre-lite' ) . '</a>';
		}
		return $excerpt;
	}
}

/**
 * Archives Titles
 *
 * @param array $title Configuration arguments.
 */
function andre_get_the_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_year() ) {
		$title = get_the_date( _x( 'Y', 'yearly archives date format', 'andre-lite' ) );
	} elseif ( is_month() ) {
		$title = get_the_date( _x( 'F Y', 'monthly archives date format', 'andre-lite' ) );
	} elseif ( is_day() ) {
		$title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'andre-lite' ) );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} else {
		$title = esc_html__( 'Archives', 'andre-lite' );
	}
	return $title;
};
add_filter( 'get_the_archive_title', 'andre_get_the_archive_title', 10, 1 );

/**
 * Defines new blog excerpt length and link text.
 *
 * @param array $item_output Configuration arguments.
 * @param array $item Configuration arguments.
 * @param array $depth Configuration arguments.
 * @param array $args Configuration arguments.
 */
function andre_nav_description( $item_output, $item, $depth, $args ) {
	if ( ! empty( $item->description ) ) {
		$item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'andre_nav_description', 10, 4 );

/**
 * Skip link function.
 */
function andre_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#contentwrapper">' . esc_html__( 'Skip to the content', 'andre-lite' ) . '</a>';
}
add_action( 'wp_body_open', 'andre_skip_link', 5 );

/**
 * Display admin notice.
 */
function andre_notice() {
	global $current_user;
	$user_id = $current_user->ID;
	if ( ! get_user_meta( $user_id, 'andre_notice_ignore' ) ) {
		echo '<div class="updated notice"><p>' . esc_html__( 'Thanks for installing Andre Lite! Want more features?', 'andre-lite' ) . '<a href="https://vivathemes.com/wordpress-theme/andre/" target="blank">' . esc_html__( 'Check Out the Pro Version  &#8594;', 'andre-lite' ) . '</a><a class="notice-dismiss" href="?andre-ignore-notice"><span class="screen-reader-text">Dismiss Notice</span></a></p></div>';
	}
}
add_action( 'admin_notices', 'andre_notice' );

/**
 * Ignore admin notice.
 */
function andre_notice_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	if ( isset( $_GET['andre-ignore-notice'] ) ) {
		add_user_meta( $user_id, 'andre_notice_ignore', 'true', true );
	}
}
add_action( 'admin_init', 'andre_notice_ignore' );

add_action( 'admin_head', 'andre_admin_style' );
/**
 * Style for nadmin notification.
 */
function andre_admin_style() {
	echo '<style>
	.notice {position: relative;}
	a.notice-dismiss {text-decoration:none;}
	</style>';
}
