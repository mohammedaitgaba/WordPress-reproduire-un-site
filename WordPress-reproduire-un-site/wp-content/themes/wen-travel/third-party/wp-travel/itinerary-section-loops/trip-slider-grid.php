<?php
/**
 * Loop file for the itinerary-section-parts > trip-slider.php
 * It provides the grid layout to the slider.
 *
 *
 * @subpackage /itinerary-section-loops
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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

?>

<div class="item">
	<div id="featured-trip-<?php the_ID(); ?>" class="hentry trip grid page">
		<div class="hentry-inner">
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php the_title(); ?>">
				</a>

				<div class="title_price_wrapper">
					<?php
						the_title(
							'<h2 class="entry-title"><a href="' . get_the_permalink() . '">',
							'</a></h2>'
						);
						echo wp_kses_post( $ratings_html );

					?>

				</div>
			</div>
			<div class="entry-container">
				<header class="entry-header">
					<div class="trip-header">
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
										<?php echo wen_travel_get_svg( array( 'icon' => 'user' ) ); echo esc_html( $pax ); ?>
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
				</header>
				<div class="inner-container">
					<div class="prices">
						<?php if ( ! empty( $trip_price ) && ! empty( $regular_price ) ) { ?>
							<div>
								<?php
								echo $trip_price ? sprintf( '<span class="amount">%s%d</span>', esc_html( $currency_code ), esc_html( $trip_price ) ) : '';
								esc_html_e( 'From', 'wen-travel' );
								
								echo $enable_sale && $regular_price ? sprintf( '<del>%s%d</del>', esc_html( $currency_code ), esc_html( $regular_price ) ) : '';
								?>
							</div>
						<?php } ?>
					</div>
					<div class="more-button">
							<a href="<?php the_permalink(); ?>" class="more-link">
								<?php esc_html_e( 'Explore', 'wen-travel' ); ?>
							</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
