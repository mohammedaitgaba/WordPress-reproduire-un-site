<?php
/**
 * This is a section file for the home pages.
 *
 *
 * @subpackage ./itinerary-section-parts
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$enable_on  = get_theme_mod( 'wen_travel_wp_travel_featured_trips_enable_on', 'disabled' );


if ( ! wen_travel_check_section( $enable_on ) ) {
	// Bail if featured content is disabled.
	return;
}
$section_title = get_theme_mod( 'wen_travel_wp_travel_featured_trips_title', esc_html__( 'Featured Trips', 'wen-travel' ) );
$layout        = get_theme_mod( 'wen_travel_wp_travel_featured_trips_layout', 'default' );

$args = array(
	'post_type'      => 'itineraries',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'meta_query'     => array( // phpcs:ignore
		array(
			'key'     => 'wp_travel_featured',
			'value'   => 'yes',
			'compare' => '=',
		),
	),
);

$the_query = new WP_Query( $args );
$class     = 'grid' === $layout ? 'featured-trip-slider-grid pl-1 pr-1' : 'featured-trip-slider';

?>
<div id="wp-travel-featured-trip-section" class="featured-trip-section section ghost-button">
	<div class="wrapper">
		<?php if ( $section_title ) { ?>
			<div class="section-heading-wrapper ">
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
				</div><!-- .section-title-wrapper -->
			</div><!-- .section-heading-wrapper -->
		<?php } ?>

		<div class="section-content-wrapper featured-trip-content-wrapper layout-two">
			<div class="<?php echo esc_attr( "{$class} trip-slider owl-carousel" ); ?>">
				<?php
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						get_template_part( 'third-party/wp-travel/itinerary-section-loops/trip-slider', $layout );
					}
				}
				?>
			</div>
		</div><!-- .section-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #wen-travel-wp-travel-trip-activities-section -->

<?php
wp_reset_postdata();
