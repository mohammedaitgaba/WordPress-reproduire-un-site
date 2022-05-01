<?php
/**
 * The template used for displaying slider
 *
 * @package WEN_Travel
 */

$quantity      = get_theme_mod( 'wen_travel_slider_number', 4 );
$no_of_post    = 0; // for number of posts
$post_list     = array(); // list of valid post/page ids

$args = array(
	'post_type'           => 'any',
	'orderby'             => 'post__in',
	'ignore_sticky_posts' => 1, // ignore sticky posts
);
//Get valid number of posts
for ( $i = 1; $i <= $quantity; $i++ ) {
	$wen_travel_post_id = '';

	$wen_travel_post_id = get_theme_mod( 'wen_travel_slider_page_' . $i );

	if ( $wen_travel_post_id && '' !== $wen_travel_post_id ) {
		$post_list = array_merge( $post_list, array( $wen_travel_post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;

if ( ! $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :
	$loop->the_post();

	$thumbnail = 'wen-travel-slider';	
	?>
	<article class="<?php echo esc_attr( 'post post-' . get_the_ID() . ' hentry slides' ); ?>">
		<div class="hentry-inner">
			<div class="slider-image-wrapper">
				<a class="cover-link" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
					<?php 
					if  ( has_post_thumbnail() ) {
						the_post_thumbnail( array(1920, 1080) );
					} else {
						echo '<img class="wp-post-image" src="' . trailingslashit( get_template_directory_uri() ) . '/images/no-thumb-1920x1080.jpg"/>';
					}
					?>
				</a>
			</div><!-- .slider-image-wrapper -->

			<div class="slider-content-wrapper">
				<div class="entry-container">
					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><span class="title-text">','</span></a></h2>' ); ?>
					</header>
				</div><!-- .entry-container -->
			</div><!-- .slider-content-wrapper -->
		</div><!-- .hentry-inner -->
	</article><!-- .slides -->
<?php
endwhile;

wp_reset_postdata();
