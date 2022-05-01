<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WEN_Travel
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since WEN Travel 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function wen_travel_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Always add a front-page class to the front page.
	if ( is_front_page() && ! is_home() ) {
		$classes[] = 'page-template-front-page';
	}

	// Adds a class of (full-width|box) to blogs.
	$classes[] = 'fluid-layout';
	
	// Adds a class of navigation-(default|classic) to blogs.
	$classes['menu-type'] = 'navigation-classic';

	// Adds a class with respect to layout selected.
	$layout  = wen_travel_get_theme_layout();
	$sidebar = wen_travel_get_sidebar_id();

	$layout_class = "no-sidebar content-width-layout";

	if ( 'no-sidebar-full-width' === $layout ) {
		$layout_class = 'no-sidebar full-width-layout';
	} elseif ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$layout_class = 'two-columns-layout content-left';
		}
	}

	$classes[] = $layout_class;

	$classes[] = 'excerpt';

	$classes[] = 'header-media-fluid';


	$header_image = wen_travel_featured_overall_image();

	if ( 'disable' !== $header_image ) {
		$classes[] = 'has-header-media';
	}

	if ( ! wen_travel_has_header_media_text() ) {
		$classes[] = 'header-media-text-disabled';
	}

	$enable_slider = wen_travel_check_section( get_theme_mod( 'wen_travel_slider_option', 'disabled' ) );

	if ( wen_travel_has_header_media_text() || 'disable' !== $header_image || $enable_slider ) {
		$classes['transparent-header'] = 'transparent-header';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Added color scheme to body class.
	$classes['color-scheme'] = 'color-scheme-default';
	$classes['header-style'] = 'header-style-one';

	return $classes;
}
add_filter( 'body_class', 'wen_travel_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function wen_travel_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'wen_travel_pingback_header' );

if ( ! function_exists( 'wen_travel_comment_form_fields' ) ) :
	/**
	 * Modify Comment Form Fields
	 *
	 * @uses comment_form_default_fields filter
	 * @since WEN Travel 1.0
	 */
	function wen_travel_comment_form_fields( $fields ) {
	    $disable_website = get_theme_mod( 'wen_travel_website_field', 1  );

	    if ( isset( $fields['url'] ) && ! $disable_website ) {
			unset( $fields['url'] );
		}

		return $fields;
	}
endif; // wen_travel_comment_form_fields.
add_filter( 'comment_form_default_fields', 'wen_travel_comment_form_fields' );

/**
 * Remove first post from blog as it is already show via recent post template
 */
function wen_travel_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$cats = get_theme_mod( 'wen_travel_front_page_category' );

		if ( is_array( $cats ) && ! in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] = $cats;
		}
	}
}
add_action( 'pre_get_posts', 'wen_travel_alter_home' );

/**
 * Function to add Scroll Up icon
 */
function wen_travel_scrollup() {
	$disable_scrollup =  ! get_theme_mod( 'wen_travel_disable_scrollup', 1 );

	if ( $disable_scrollup ) {
		return;
	}

	echo '<a href="#masthead" id="scrollup" class="backtotop">' . wen_travel_get_svg( array( 'icon' => 'scrollup' ) ) . '<span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'wen-travel' ) . '</span></a>' ;
} 
add_action( 'wp_footer', 'wen_travel_scrollup', 1 );

if ( ! function_exists( 'wen_travel_content_nav' ) ) :
	/**
	 * Display navigation/pagination when applicable
	 *
	 * @since WEN Travel 1.0
	 */
	function wen_travel_content_nav() {
		global $wp_query;

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) ) {
			// Support infinite scroll plugins.
			the_posts_navigation();
		}  else {
			the_posts_navigation();
		}
	}
endif; // wen_travel_content_nav

/**
 * Check if a section is enabled or not based on the $value parameter
 * @param  string $value Value of the section that is to be checked
 * @return boolean return true if section is enabled otherwise false
 */
function wen_travel_check_section( $value ) {
	return ( 'entire-site' == $value  || ( is_front_page() && 'homepage' === $value ) );
}

/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since WEN Travel 1.0
 */
function wen_travel_get_first_image( $postID, $size, $attr, $src = false ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if ( isset( $matches[1][0] ) ) {
		// Get first image.
		$first_img = $matches[1][0];

		if ( $src ) {
			//Return url of src is true
			return $first_img;
		}

		return '<img class="wp-post-image" src="'. esc_url( $first_img ) .'">';
	}

	return false;
}

function wen_travel_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = get_theme_mod( 'wen_travel_default_layout', 'right-sidebar' );

		if ( is_home() || is_archive() ) {
			$layout = get_theme_mod( 'wen_travel_homepage_archive_layout', 'no-sidebar-full-width' );
		}
	}

	return $layout;
}

function wen_travel_get_sidebar_id() {
	$sidebar = $id = '';

	$layout = wen_travel_get_theme_layout();

	if ( 'no-sidebar-full-width' === $layout || 'no-sidebar' === $layout ) {
		return $sidebar;
	}

	$sidebaroptions = get_post_meta( $id, 'wen-travel-sidebar-option', true );

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$sidebar = 'sidebar-1'; // Primary Sidebar.
	}

	return $sidebar;
}

if ( ! function_exists( 'wen_travel_truncate_phrase' ) ) :
	/**
	 * Return a phrase shortened in length to a maximum number of characters.
	 *
	 * Result will be truncated at the last white space in the original string. In this function the word separator is a
	 * single space. Other white space characters (like newlines and tabs) are ignored.
	 *
	 * If the first `$max_characters` of the string does not contain a space character, an empty string will be returned.
	 *
	 * @since WEN Travel 1.0
	 *
	 * @param string $text            A string to be shortened.
	 * @param integer $max_characters The maximum number of characters to return.
	 *
	 * @return string Truncated string
	 */
	function wen_travel_truncate_phrase( $text, $max_characters ) {

		$text = trim( $text );

		if ( mb_strlen( $text ) > $max_characters ) {
			//* Truncate $text to $max_characters + 1
			$text = mb_substr( $text, 0, $max_characters + 1 );

			//* Truncate to the last space in the truncated string
			$text = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
		}

		return $text;
	}
endif; //wen_travel_truncate_phrase

if ( ! function_exists( 'wen_travel_get_the_content_limit' ) ) :
	/**
	 * Return content stripped down and limited content.
	 *
	 * Strips out tags and shortcodes, limits the output to `$max_char` characters, and appends an ellipsis and more link to the end.
	 *
	 * @since WEN Travel 1.0
	 *
	 * @param integer $max_characters The maximum number of characters to return.
	 * @param string  $more_link_text Optional. Text of the more link. Default is "(more...)".
	 * @param bool    $stripteaser    Optional. Strip teaser content before the more text. Default is false.
	 *
	 * @return string Limited content.
	 */
	function wen_travel_get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

		$content = get_the_content( '', $stripteaser );

		// Strip tags and shortcodes so the content truncation count is done correctly.
		$content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

		// Remove inline styles / .
		$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );

		// Truncate $content to $max_char
		$content = wen_travel_truncate_phrase( $content, $max_characters );

		// More link?
		if ( $more_link_text ) {
			$link   = apply_filters( 'get_the_content_more_link', sprintf( '<a href="%s" class="more-link">%s</a>', esc_url( get_permalink() ), $more_link_text ), $more_link_text );
			$output = sprintf( '<p>%s %s</p>', $content, $link );
		} else {
			$output = sprintf( '<p>%s</p>', $content );
			$link = '';
		}

		return apply_filters( 'wen_travel_get_the_content_limit', $output, $content, $link, $max_characters );

	}
endif; //wen_travel_get_the_content_limit

if ( ! function_exists( 'wen_travel_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply fabulous-fluid your own wen_travel_content_image(), and that function will be used instead.
	 *
	 * @since WEN Travel 1.0
	 */
	function wen_travel_content_image() {
		if ( has_post_thumbnail() && wen_travel_jetpack_featured_image_display() && is_singular() ) {
			global $post, $wp_query;

			// Get Page ID outside Loop.
			$page_id = $wp_query->get_queried_object_id();

			if ( $post ) {
		 		if ( is_attachment() ) {
					$parent = $post->post_parent;

					$individual_featured_image = get_post_meta( $parent, 'wen-travel-featured-image', true );
				} else {
					$individual_featured_image = get_post_meta( $page_id, 'wen-travel-featured-image', true );
				}
			}

			if ( empty( $individual_featured_image ) ) {
				$individual_featured_image = 'default';
			}

			if ( 'disable' === $individual_featured_image ) {
				return false;
			} else {
				$class = array();

				$image_size = 'post-thumbnail';

				if ( 'default' !== $individual_featured_image ) {
					$image_size = $individual_featured_image;
					$class[]    = 'from-metabox';
				} else {
					$layout = wen_travel_get_theme_layout();

					if ( 'no-sidebar-full-width' === $layout ) {
						$image_size = 'wen-travel-slider';
					}
				}

				$class[] = $individual_featured_image;
				?>
				<div class="post-thumbnail <?php echo esc_attr( implode( ' ', $class ) ); ?>">
					<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $image_size ); ?>
					</a>
				</div>
		   	<?php
			}
		} // End if ().
	}
endif; // wen_travel_content_image.

if ( ! function_exists( 'wen_travel_sections' ) ) :
	/**
	 * Display Sections on header and footer with respect to the section option set in wen_travel_sections_sort
	 */
	function wen_travel_sections( $selector = 'header' ) {
		get_template_part( 'template-parts/header/header-media' );
		get_template_part( 'template-parts/slider/display-slider' );
		get_template_part( 'third-party/wp-travel/template-parts/trip-filter' );
		get_template_part( 'third-party/wp-travel/template-parts/featured-trips' );
		get_template_part( 'template-parts/hero-content/content-hero' );
		get_template_part( 'template-parts/service/display-service' );
		get_template_part( 'template-parts/portfolio/display-portfolio' );
		get_template_part( 'template-parts/testimonial/display-testimonial' );
		get_template_part( 'third-party/wp-travel/template-parts/latest-trips' );
		get_template_part( 'template-parts/featured-content/display-featured' );	
	}
endif;

if ( ! function_exists( 'wen_travel_post_thumbnail' ) ) :
	/**
	 * $image_size post thumbnail size
	 * $type html, html-with-bg, url
	 * $echo echo true/false
	 * $no_thumb display no-thumb image or not
	 */
	function wen_travel_post_thumbnail( $image_size = 'post-thumbnail', $type = 'html', $echo = true, $no_thumb = false ) {
		$image = $image_url = '';
		
		if ( has_post_thumbnail() ) {
			$image_url = get_the_post_thumbnail_url( get_the_ID(), $image_size );
			$image     = get_the_post_thumbnail( get_the_ID(), $image_size );
		} else {
			if ( $no_thumb ) {
				if ( is_array( $image_size ) ) {
					$image_url  = trailingslashit( get_template_directory_uri() ) . '/images/no-thumb-' . $image_size[0] . 'x' . $image_size[1] . '.jpg';
				} else {
					global $_wp_additional_image_sizes;

					$image_url  = trailingslashit( get_template_directory_uri() ) . '/images/no-thumb-' . $_wp_additional_image_sizes[ $image_size ]['width'] . 'x' . $_wp_additional_image_sizes[ $image_size ]['height'] . '.jpg';
				}
				$image      = '<img src="' . esc_url( $image_url ) . '" alt="" />';
			}

			// Get the first image in page, returns false if there is no image.
			$first_image_url = wen_travel_get_first_image( get_the_ID(), $image_size, '', true );

			// Set value of image as first image if there is an image present in the page.
			if ( $first_image_url ) {
				$image_url = $first_image_url;
				$image = '<img class="wp-post-image" src="'. esc_url( $image_url ) .'">';
			}
		}

		if ( ! $image_url ) {
			// Bail if there is no image url at this stage.
			return;
		}

		if ( 'url' === $type ) {
			return $image_url;
		}

		$output = '<div';

		if ( 'html-with-bg' === $type ) {
			$output .= ' class="post-thumbnail-background" style="background-image: url( ' . esc_url( $image_url ) . ' )"';
		} else {
			$output .= ' class="post-thumbnail"';
		}

		$output .= '>';

		$output .= '<a class="cover-link" href="' . esc_url( get_the_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '">';

		if ( 'html-with-bg' !== $type ) {
			$output .= $image;
		}

		$output .= '</a></div><!-- .post-thumbnail -->';

		if ( ! $echo ) {
			return $output;
		}

		echo $output;
	}
endif;
