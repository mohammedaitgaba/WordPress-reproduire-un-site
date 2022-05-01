<?php
/**
 * This is a file provides the section for the frontpage.
 * It was earlier named as Trip Two Column and then later renamed as Latest Trips.
 *
 * For inner loops:
 *
 * @see ./itinerary-section-loops/latest-trips.php
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

$enable_on  = get_theme_mod( 'wen_travel_wp_travel_latest_trips_enable_on', 'disabled' );

if ( ! wen_travel_check_section( $enable_on ) ) {
	// Bail if featured content is disabled.
	return;
}

$section_title = get_theme_mod( 'wen_travel_wp_travel_latest_trips_title', esc_html__( 'Latest Trips', 'wen-travel' ) );
$taxonomy_name = get_theme_mod( 'wen_travel_wp_travel_latest_trips_tax_dropdown', 'mixed' );

$args = array(
	'post_type'      => 'itineraries',
	'post_status'    => 'publish',
	'posts_per_page' => 4,
);

if ( 'mixed' !== $taxonomy_name ) {
	$term_array = array();
	$terms      = get_terms(
		array(
			'taxonomy'   => $taxonomy_name,
			'hide_empty' => false,
		)
	);

	$itinerary_term[] = get_theme_mod( "wen_travel_wp_travel_latest_trips_{$taxonomy_name}_terms" );

	 $args['tax_query'] = array( // phpcs:ignore
		array(
			'taxonomy' => $taxonomy_name,
			'terms'    => $itinerary_term,
			'field'    => 'slug',
		),
	);
}

$the_query = new WP_Query( $args );
?>
<div id="wen-travel-wp-travel-trip-two-column-section" class="latest-trip-section section">
	<div class="wrapper">
		<?php if ( $section_title ) { ?>
			<div class="section-heading-wrapper ">
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
				</div><!-- .section-title-wrapper -->
			</div><!-- .section-heading-wrapper -->
		<?php } ?>

		<div class="section-content-wrapper trip-content-wrapper layout-two">
			<?php
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					
					$wp_travel_metas = wen_travel_wp_travel_get_itinerary_meta();

					// Prices and currency.
					$currency_code = ! empty( $wp_travel_metas['prices']['currency_code'] ) ? $wp_travel_metas['prices']['currency_code'] : false;
					$enable_sale   = ! empty( $wp_travel_metas['prices']['enable_sale'] ) ? $wp_travel_metas['prices']['enable_sale'] : false;
					$regular_price = ! empty( $wp_travel_metas['prices']['regular_price'] ) ? $wp_travel_metas['prices']['regular_price'] : false;
					$trip_price    = ! empty( $wp_travel_metas['prices']['trip_price'] ) ? $wp_travel_metas['prices']['trip_price'] : false; // This will give sales price if sale is enabled.

					$pax          = ! empty( $wp_travel_metas['general']['pax'] ) ? $wp_travel_metas['general']['pax'] : '';
					$ratings_html = ! empty( $wp_travel_metas['general']['ratings_html'] ) ? $wp_travel_metas['general']['ratings_html'] : '';
					$thumbnail    = ! empty( $wp_travel_metas['thumbnails']['url'] ) ? $wp_travel_metas['thumbnails']['url'] : wen_travel_wp_travel_get_placeholder_image_url( '640x480' );

					$activities    = ! empty( $wp_travel_metas['trip_terms']['activity'] ) ? $wp_travel_metas['trip_terms']['activity'] : '';
					$activity      = ! empty( $activities[0] ) ? $activities[0] : '';
					$activity_id   = ! empty( $activity->term_id ) ? $activity->term_id : '';
					$activity_name = ! empty( $activity->name ) ? $activity->name : '';
					$activity_link = ! empty( $activity_id ) ? get_term_link( $activity_id ) : '';

					/**
					 * $current_trip_index is set from loop using set_query_var function.
					 */
					$is_first_post       = ( 0 === $the_query->current_post );
					$featured_post_class = $is_first_post ? 'featured' : '';

					?>

					<article id="trip-two-column-inner-<?php the_ID(); ?>" class="hentry trip <?php echo esc_attr( $featured_post_class ); ?>">
						<div class="hentry-inner">
							<?php if ( $thumbnail ) { ?>
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php the_title(); ?>">
								</a>
								<div class="entry-header">
									<?php
										the_title(
											'<h2 class="entry-title"><a href="' . get_the_permalink() . '">',
											'</a></h2>'
										);
									?>
									<?php echo wp_kses_post( $ratings_html ); ?>
								</div>
							</div>
							<?php } ?>
							<div class="entry-container">
								<div class="meta-wrapper">		

									<div class="entry-meta">
										<ul class="list-inline">
											<?php
											if ( $activity_name ) {
												?>
											<li class="list-inline-item">
												<a href="<?php echo esc_url( $activity_link ); ?>" class=""><?php echo wen_travel_get_svg( array( 'icon' => 'paper-plane' ) ); echo esc_html( $activity_name ); ?></a>
											</li>
												<?php
											}
											if ( $pax ) {
												?>
												<li class="list-inline-item">
													<?php echo wen_travel_get_svg( array( 'icon' => 'user' ) ); ?><?php echo esc_html( $pax ); ?>
												</li>
												<?php
											}
											the_date(
												'',
												'<li class="list-inline-item">' . wen_travel_get_svg( array( 'icon' => 'clock' ) ) .' ',
												'</li>'
											);
											?>
										</ul>
									</div>

									
								</div>
								<?php if ( get_the_excerpt() ) { ?>
								<div class="entry-summary">
									<?php the_excerpt(); ?>
									<?php
									if ( ! empty( $trip_price ) && ! empty( $regular_price ) ) {
										?>
										<div class="price">
											<?php
											esc_html_e( 'From', 'wen-travel' );
											echo $enable_sale && $regular_price ? sprintf( '<del>%s%d</del>', esc_html( $currency_code ), esc_html( $regular_price ) ) : '';
											echo $trip_price ? sprintf( '<span class="amount">%s%d</span> ', esc_html( $currency_code ), esc_html( $trip_price ) ) : '';
											?>
										</div>
										<?php
									}
									?>
									<div class="more-button ghost-button">
										<a href="<?php the_permalink(); ?>" class="more-link">
											<?php esc_html_e( 'Explore', 'wen-travel' ); ?>
										</a>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</article><!-- #trip-two-column-inner-<?php the_ID(); ?> -->
					<?php
				}
			}
			?>
		</div><!-- .section-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #wen-travel-wp-travel-trip-two-column-section -->
<?php
wp_reset_postdata();
