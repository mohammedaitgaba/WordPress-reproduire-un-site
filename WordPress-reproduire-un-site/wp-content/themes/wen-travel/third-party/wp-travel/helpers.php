<?php
/**
 * This file has important functions to help the smooth work flow.
 *
 *
 * @subpackage /inc
 */

if ( ! function_exists( 'wen_travel_wp_travel_get_placeholder_image_url' ) ) {
	/**
	 * Returns the placeholder image url from the parent directory according to the provided size.
	 *
	 * @param string $size Image size.
	 */
	function wen_travel_wp_travel_get_placeholder_image_url( $size = '820x615' ) {
		return trailingslashit( esc_url ( get_template_directory_uri() ) ) . "//images/no-thumb-{$size}.jpg";
	}
}

if ( ! function_exists( 'wen_travel_wp_travel_get_itinerary_meta' ) ) {

	/**
	 * Returns the array of wp travel trips meta informations.
	 *
	 * @param array $args Arguments for wp travel meta datas. It accepts the following values:
	 *                    * trip_id        => WP Travel Trip ID, default is get_the_ID().
	 *                    * retrive        => Type of meta that you want to receive, default is all.
	 *                                        # Other accepted values are:
	 *                                          * all ( default ),
	 *                                          * general,
	 *                                          * prices,
	 *                                          * date_and_time,
	 *                                          * trip_terms,
	 *                                          * thumbnails,
	 *                    * featured_trips => If passed true, then function will returns
	 *                                        the meta info for featured trips only.
	 *                                        Default is false.
	 *
	 * @return array $wp_travel_meta Array of WP Travel meta data.
	 */
	function wen_travel_wp_travel_get_itinerary_meta( $args = array() ) {

		$wp_travel_meta = array();

		if ( ! class_exists( 'Wen_Travel_WP_Travel_Metas' ) ) {
			require get_parent_theme_file_path( '/third-party/wp-travel/classes/class-wp-travel-metas.php' );
		}

		$default = array(
			'trip_id'        => get_the_ID(),
			'retrive'        => 'all',
			'featured_trips' => false,
		);
		$args    = wp_parse_args( $args, $default );

		$trip_id        = ! empty( $args['trip_id'] ) ? $args['trip_id'] : false;
		$retrive        = ! empty( $args['retrive'] ) ? $args['retrive'] : 'all';
		$featured_trips = ! empty( $args['featured_trips'] ) ? $args['featured_trips'] : false;

		// Bail early if trip id is empty.
		if ( empty( $trip_id ) ) {
			return $wp_travel_meta;
		}

		// Bail early if provided post id is not WP Travel Itinerary post.
		if ( 'itineraries' !== get_post_type( $trip_id ) ) {
			return $wp_travel_meta;
		}

		$meta_object   = new Wen_Travel_WP_Travel_Metas( $trip_id );
		$general       = $meta_object->general();
		$prices        = $meta_object->prices();
		$date_and_time = $meta_object->date_and_time();
		$trip_terms    = $meta_object->trip_terms();
		$thumbnails    = $meta_object->thumbnails();

		/**
		 * Create the meta array.
		 */
		$itinerary_meta = array(
			'general'       => $general,
			'prices'        => $prices,
			'date_and_time' => $date_and_time,
			'trip_terms'    => $trip_terms,
			'thumbnails'    => $thumbnails,
		);
		$wp_travel_meta = $itinerary_meta;

		/**
		 * If $args['featured_trips'] is passed true then
		 * reset the array and list only featured trips.
		 */
		if ( $featured_trips && 'yes' === $itinerary_meta['general']['is_featured'] ) {
			$wp_travel_meta = array();
			$wp_travel_meta = $itinerary_meta;
		}

		if ( 'all' === $retrive ) {
			return $wp_travel_meta;
		}

		return ! empty( $wp_travel_meta[ $retrive ] ) ? $wp_travel_meta[ $retrive ] : array();
	}
}
