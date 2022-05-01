<?php
/**
 * This is a section file for the home pages.
 *
 *
 * @subpackage ./itinerary-section-parts
 */

$wen_travel_enable = get_theme_mod( 'wen_travel_wp_travel_trip_filter_enable_on', 'disabled' );

if ( ! wen_travel_check_section( $wen_travel_enable ) ) {
	// Bail if featured content is disabled.
	return;
}

$wen_travel_main_image       = get_theme_mod( 'wen_travel_wp_travel_trip_filter_main_image' );
$wen_travel_enable_locations = get_theme_mod( 'wen_travel_wp_travel_trip_filter_enable_locations', 1 );
$wen_travel_enable_itinerary = get_theme_mod( 'wen_travel_wp_travel_trip_filter_enable_itinerary', 1 );
$wen_travel_keyword          = get_theme_mod( 'wen_travel_wp_travel_trip_filter_keyword', esc_html__( 'Keyword', 'wen-travel' ) );

$classes[] = 'trip-filter-section section';

$style = '';
if ( $wen_travel_main_image ) {
	$classes[] = 'has-background-image';

	$style = 'background-image: url("' . esc_url( $wen_travel_main_image ) . '");';
}
?>
<div id="trip-filter-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="<?php echo esc_attr( $style ); ?>">
	<form class="description-box" action="">
		<?php if ( $wen_travel_enable_locations ) : ?>
		<div class="item item-1">
			<?php echo wen_travel_get_svg( array( 'icon' => 'user' ) ); 
			
				if ( taxonomy_exists( 'travel_locations' ) ) {
					$taxonomy_name = 'travel_locations';
					
					$args          = array(
						'show_option_all'   => esc_html__( 'All Location', 'wen-travel' ),
						'show_option_none'  => esc_html__( 'All Location', 'wen-travel' ),
						'option_none_value' => esc_html__( 'All Location', 'wen-travel' ),
						'hide_empty'        => 0,
						'selected'          => 1,
						'hierarchical'      => 1,
						'name'              => $taxonomy_name,
						'class'             => 'wp-travel-taxonomy',
						'taxonomy'          => $taxonomy_name,
						'value_field'       => 'slug',
					);

					wp_dropdown_categories( $args, $taxonomy_name );
				} elseif ( current_user_can( 'edit_theme_options' ) ) { 
					echo '<p>Add travel locations</p>';
				}
				?>
		</div>
		<?php endif; ?>

		<?php if ( $wen_travel_enable_itinerary ) : ?>
		<div class="item item-2">
			<?php echo wen_travel_get_svg( array( 'icon' => 'map-signs' ) ); 
				if ( taxonomy_exists( 'itinerary_types' ) ) {
					$taxonomy_name = 'itinerary_types';
					
					$args          = array(
						'show_option_all'   => esc_html__( 'Trip Types', 'wen-travel' ),
						'show_option_none'  => esc_html__( 'Trip Types', 'wen-travel' ),
						'option_none_value' => esc_html__( 'Trip Types', 'wen-travel' ),
						'hide_empty'        => 1,
						'selected'          => 1,
						'hierarchical'      => 1,
						'name'              => $taxonomy_name,
						'class'             => 'wp-travel-taxonomy select-2',
						'taxonomy'          => $taxonomy_name,
						'value_field'       => 'slug',
					);
					
					wp_dropdown_categories( $args, $taxonomy_name );
				} elseif ( current_user_can( 'edit_theme_options' ) ) { 
					echo '<p>Add Itinerary Types<p>';
				}
				?>
		</div>
		<?php endif; ?>

		<div class="item item-3">
			<input type="text" name="s" placeholder="<?php echo esc_attr( $wen_travel_keyword ); ?>" id="search">
		</div>
		<div class="item item-4">
			<button type="submit" class="primary-button"><?php echo wen_travel_get_svg( array( 'icon' => 'search' ) ); esc_html_e( 'Search', 'wen-travel' ); ?></button>
		</div>
	</form>
</div>
