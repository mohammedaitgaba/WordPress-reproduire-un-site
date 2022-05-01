<?php
/**
 * The template for displaying portfolio items
 *
 * @package WEN_Travel
 */

$number = get_theme_mod( 'wen_travel_portfolio_number', 3 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$wen_travel_args = array(
	'orderby'             => 'post__in',
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$post_list  = array();// list of valid post/page ids

$no_of_post = 0; // for number of posts

$wen_travel_args['post_type'] = 'page';

for ( $i = 1; $i <= $number; $i++ ) {
	$wen_travel_post_id = '';

	$wen_travel_post_id = get_theme_mod( 'wen_travel_portfolio_page_' . $i );

	if ( $wen_travel_post_id && '' !== $wen_travel_post_id ) {
		// Polylang Support.
		if ( class_exists( 'Polylang' ) ) {
			$wen_travel_post_id = pll_get_post( $wen_travel_post_id, pll_current_language() );
		}

		$post_list = array_merge( $post_list, array( $wen_travel_post_id ) );

		$no_of_post++;
	}
}

$wen_travel_args['post__in'] = $post_list;

if ( 0 === $no_of_post ) {
	return;
}

$wen_travel_args['posts_per_page'] = $no_of_post;
$loop     = new WP_Query( $wen_travel_args );

$slider_select = get_theme_mod( 'wen_travel_portfolio_slider', 1 );

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();

		get_template_part( 'template-parts/portfolio/content', 'portfolio' );

	endwhile;
	wp_reset_postdata();
endif;
