<?php
/**
 * The template for displaying testimonial items
 *
 * @package WEN_Travel
 */

$enable = get_theme_mod( 'wen_travel_testimonial_option', 'disabled' );

if ( ! wen_travel_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}

$wen_travel_title       = get_theme_mod( 'wen_travel_testimonial_title' );
$wen_travel_description = get_theme_mod( 'wen_travel_testimonial_description' );

$classes[] = 'section testimonial-content-section';

if ( ! $wen_travel_title && ! $wen_travel_description ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="testimonial-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<div class="full-content-wrap full-width">

			<?php if ( $wen_travel_title || $wen_travel_description ) : ?>
				<div class="section-heading-wrapper">

					<?php if ( $wen_travel_title ) : ?>
						<div class="section-title-wrapper">
							<h2 class="section-title"wen_travel_><?php echo wp_kses_post( $wen_travel_title ); ?></h2>
						</div><!-- .page-title-wrapper -->
					<?php endif; ?>

					<?php if ( $wen_travel_description ) : ?>
						<div class="section-description">
							<p>
								<?php
									echo wp_kses_post( $wen_travel_description );
								?>
							</p>
						</div><!-- .section-description-wrapper -->
					<?php endif; ?>
				</div><!-- .section-heading-wrapper -->
			<?php endif; ?>

			<div class="section-content-wrapper testimonial-content-wrapper testimonial-slider owl-carousel owl-dots-enabled">
				<?php get_template_part( 'template-parts/testimonial/post-types-testimonial' ); ?>
			</div><!-- .section-content-wrapper -->
		</div><!-- .full-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- .testimonial-content-section -->
