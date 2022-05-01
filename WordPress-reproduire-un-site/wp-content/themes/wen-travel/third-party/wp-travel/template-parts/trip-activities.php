<?php
/**
 * This is a section file for the home pages.
 *
 *
 * @subpackage ./itinerary-section-parts
 */

$wen_travel_enable = get_theme_mod( 'wen_travel_wp_travel_trip_activities_enable_on', 'disabled' );

if ( ! wen_travel_check_section( $wen_travel_enable ) ) {
	// Bail if featured content is disabled.
	return;
}

$section_title = get_theme_mod( 'wen_travel_wp_travel_trip_activities_title', esc_html__( 'Trip Activities', 'wen-travel' ) );

?>
<div id="wen-travel-wp-travel-trip-activities-section" class="trip-activities-section section">
	<div class="wrapper">
		<?php if ( $section_title ) { ?>
			<div class="section-heading-wrapper ">
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
				</div><!-- .section-title-wrapper -->
			</div><!-- .section-heading-wrapper -->
		<?php } ?>

		<div class="section-content-wrapper activities-content-wrapper row layout-three">
			<?php
			$hide_empty = get_theme_mod( 'wen_travel_wp_travel_trip_activities_hide_empty', 1 );

			$args = array(
				'taxonomy'   => 'activity',
				'hide_empty' => $hide_empty,
			);

			$trip_activities = get_terms( $args );

			if ( is_array( $trip_activities ) && count( $trip_activities ) > 0 ) {
				foreach ( $trip_activities as $trip_activity ) {

					$no_trips = esc_html__( 'No', 'wen-travel' );

					// General.
					$activity_id   = ! empty( $trip_activity->term_id ) ? $trip_activity->term_id : false;
					$activity_name = ! empty( $trip_activity->name ) ? $trip_activity->name : false;
					$trip_count    = ! empty( $trip_activity->count ) && ( $trip_activity->count ) > 0 ? $trip_activity->count : $no_trips;
					$activity_link = get_term_link( $activity_id );

					// Attachments.
					$thumbnail_id  = get_term_meta( $activity_id, 'wp_travel_trip_type_image_id', true );
					$thumbnail_url = wp_get_attachment_url( $thumbnail_id );
					$thumbnail_url = ! empty( $thumbnail_url ) ? $thumbnail_url : wen_travel_wp_travel_get_placeholder_image_url( '640x480' );
					?>
					<div id="trip-activities-<?php echo esc_attr( $activity_id ); ?>" class="hentry page">
						<div class="hentry-inner">
							<div class="post-thumbnail">
								<a href="<?php echo esc_url( $activity_link ); ?>">
									<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $activity_name ); ?>">
								</a>
							</div>
							<div class="entry-container">
								<header class="entry-header">
									<h2 class="entry-title">
										<a href="<?php echo esc_url( $activity_link ); ?>"><?php echo esc_html( $activity_name ); ?></a>
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
</div><!-- #wen-travel-wp-travel-trip-activities-section -->
