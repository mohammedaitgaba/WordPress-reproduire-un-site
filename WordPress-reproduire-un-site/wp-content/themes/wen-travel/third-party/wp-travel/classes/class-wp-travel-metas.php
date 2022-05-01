<?php
/**
 * This class file provides the information of wp travel related meta datas
 * which will be later used by the function in helpers.php.
 *
 *
 * @subpackage ./classes
 */

if ( ! class_exists( 'Wen_Travel_WP_Travel_Metas' ) ) {

	/**
	 * Class for providing wp travel meta data.
	 *
	 * @since 1.0.0
	 */
	class Wen_Travel_WP_Travel_Metas {

		/**
		 * WP Travel trip id.
		 *
		 * @var int WP Travel trip id.
		 */
		private $trip_id = 0;

		/**
		 * Initialize class.
		 *
		 * @param int $trip_id WP Travel trip id.
		 */
		public function __construct( $trip_id ) {

			if ( empty( $trip_id ) ) {
				return;
			}

			if ( 'itineraries' !== get_post_type( $trip_id ) ) {
				return;
			}

			$this->trip_id = $trip_id;
		}

		/**
		 * Returns the trip title, excerpt and permalink.
		 */
		public function general() {
			$trip_id = $this->trip_id;

			/**
			 * Buffer the html codes in a variable.
			 */
			ob_start();
			wptravel_trip_rating( $trip_id );
			$ratings_html = ob_get_clean();

			return array(
				'trip_id'      => $trip_id,
				'is_featured'  => get_post_meta( $trip_id, 'wp_travel_featured', true ),
				'title'        => get_the_title( $trip_id ),
				'excerpt'      => get_the_excerpt( $trip_id ),
				'pax'          => wptravel_get_group_size( $trip_id ),
				'ratings'      => wptravel_get_average_rating( $trip_id ),
				'ratings_html' => $ratings_html,
				'permalink'    => get_the_permalink( $trip_id ),
			);
		}

		/**
		 * List the wp travel date and time.
		 */
		public function date_and_time() {
			$trip_id = $this->trip_id;
			
			return array(
				'trip_start_date'     => get_post_meta( $trip_id, 'wp_travel_start_date', true ),
				'trip_end_date'       => get_post_meta( $trip_id, 'wp_travel_end_date', true ),
				'trip_duration_day'   => get_post_meta( $trip_id, 'wp_travel_trip_duration', true ),
				'trip_duration_night' => get_post_meta( $trip_id, 'wp_travel_trip_duration_night', true ),
			);
		}

		/**
		 * All available Itinerary terms.
		 */
		public function trip_terms() {
			$trip_id = $this->trip_id;
			
			return array(
				'travel_locations' => get_the_terms( $trip_id, 'travel_locations' ),
				'itinerary_types'  => get_the_terms( $trip_id, 'itinerary_types' ),
				'activity'         => get_the_terms( $trip_id, 'activity' ),
			);
		}

		/**
		 * Returns the trip thumbnails url and html.
		 *
		 * @param string $size Post thumbnail size, default is large.
		 */
		public function thumbnails( $size = 'large' ) {
			$trip_id = $this->trip_id;
			
			return array(
				'url'             => get_the_post_thumbnail_url( $trip_id, $size ),
				'placeholder_url' => wptravel_get_post_placeholder_image_url(),
			);
		}

		/**
		 * WP Travel pricings meta data.
		 * The wp travel functions used below are multiple currency feature compatible.
		 */
		public function prices() {
			$trip_id = array ( 'trip_id' => $this->trip_id );
			
			return array(
				'currency_code'  => wptravel_get_currency_symbol(),
				'price_per_text' => wptravel_get_price_per_text( $trip_id ),
				'enable_sale'    => WP_Travel_Helpers_Trips::is_sale_enabled( $trip_id, true ),
				'trip_price'     => WP_Travel_Helpers_Pricings::get_price( $trip_id ), // This will return sales price if second param is false and sale is enabled.
				'regular_price'  => WP_Travel_Helpers_Pricings::get_price( $trip_id, true ),
				'sale_price'     => WP_Travel_Helpers_Pricings::get_price( $trip_id ),
			);
		}
	}
}
