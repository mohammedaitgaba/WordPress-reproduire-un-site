<?php
/**
 * The template for displaying service content
 *
 * @package WEN_Travel
 */

$enable_content = get_theme_mod( 'wen_travel_service_option', 'disabled' );

if ( ! wen_travel_check_section( $enable_content ) ) {
	// Bail if service content is disabled.
	return;
}

$wen_travel_title       = get_theme_mod( 'wen_travel_service_title' );
$wen_travel_description = get_theme_mod( 'wen_travel_service_description' );

$classes[] = 'service-section';
$classes[] = 'section';
$classes[] = 'text-align-center';

if ( ! $wen_travel_title && ! $wen_travel_description ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="service-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
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

		<div class="section-content-wrapper service-content-wrapper layout-three">
			<?php get_template_part( 'template-parts/service/content-service' ); ?>
		</div><!-- .service-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #service-section -->
