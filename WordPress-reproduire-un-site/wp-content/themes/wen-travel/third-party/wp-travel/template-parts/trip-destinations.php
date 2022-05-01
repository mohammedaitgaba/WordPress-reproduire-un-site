<?php
/**
 * This is a section file for the home pages.
 * This file was earlier named as Popular Destination,
 * later it was renamed to Trip Destinations.
 *
 *
 * @subpackage ./itinerary-section-parts
 */

$wen_travel_enable = get_theme_mod( 'wen_travel_wp_travel_trip_destinations_enable_on', 'disabled' );

if ( ! wen_travel_check_section( $wen_travel_enable ) ) {
	// Bail if featured content is disabled.
	return;
}

$wen_travel_title = get_theme_mod( 'wen_travel_wp_travel_trip_destinations_title', esc_html__( 'Trip Destinations', 'wen-travel' ) );
?>

<div id="wen-travel-wp-travel-trip-destinations-section" class="trip-destinations-section section">
	<div class="wrapper">

		<?php if ( $wen_travel_title ) { ?>
			<div class="section-heading-wrapper ">
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo esc_html( $wen_travel_title ); ?></h2>
				</div><!-- .section-title-wrapper -->
			</div><!-- .section-heading-wrapper -->
		<?php } ?>

		<div class="section-content-wrapper row destination-content-wrapper layout-three">
			<?php
			$hide_empty = get_theme_mod( 'wen_travel_wp_travel_trip_destinations_hide_empty', 1 );

			$args = array(
				'taxonomy'   => 'travel_locations',
				'hide_empty' => $hide_empty,
			);

			$popular_destinations = get_terms( $args );

			if ( is_array( $popular_destinations ) && count( $popular_destinations ) > 0 ) {
				foreach ( $popular_destinations as $destination ) {

					$no_trips = esc_html__( 'No', 'wen-travel' );

					// General.
					$destination_id   = ! empty( $destination->term_id ) ? $destination->term_id : false;
					$destination_name = ! empty( $destination->name ) ? $destination->name : false;
					$trip_count       = ! empty( $destination->count ) && ( $destination->count ) > 0 ? $destination->count : $no_trips;
					$destination_link = get_term_link( $destination_id );

					// Attachments.
					$thumbnail_id  = get_term_meta( $destination_id, 'wp_travel_trip_type_image_id', true );
					$thumbnail_url = wp_get_attachment_url( $thumbnail_id );
					$thumbnail_url = ! empty( $thumbnail_url ) ? $thumbnail_url : wen_travel_wp_travel_get_placeholder_image_url( '640x480' );
					?>
					<div id="popular-destination-<?php echo esc_attr( $destination_id ); ?>" class="hentry page">
						<div class="hentry-inner">
							<div class="post-thumbnail">
								<a href="<?php echo esc_url( $destination_link ); ?>">
									<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $destination_name ); ?>">
								</a>
							</div>
							<div class="entry-container">
								<header class="entry-header">
									<h2 class="entry-title">
										<a href="<?php echo esc_url( $destination_link ); ?>"><?php echo esc_html( $destination_name ); ?></a>
									</h2>
									<?php
									$trip_string = ( $no_trips === $trip_count || $trip_count > 1 ) ? __( 'Trips', 'wen-travel' ) : __( 'Trip', 'wen-travel' );

									/* translators: %3$s this provides the 'Trips' string. It can be plural or singular. */
									echo sprintf( '%1$s %2$s ' . esc_html__( '%3$s Available', 'wen-travel' ) . '%4$s', '<span class="entry-count">', esc_html( $trip_count ), esc_html( $trip_string ), '</span>' );
									?>
								</header>
							</div>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div><!-- .section-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #wen-travel-wp-travel-trip-destinations-section -->
