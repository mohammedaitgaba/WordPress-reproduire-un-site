<?php
/**
 * The template for displaying portfolio items
 *
 * @package WEN_Travel
 */
?>

<?php
$enable = get_theme_mod( 'wen_travel_portfolio_option', 'disabled' );

if ( ! wen_travel_check_section( $enable ) ) {
	// Bail if portfolio section is disabled.
	return;
}

$wen_travel_title       = get_theme_mod( 'wen_travel_portfolio_title');
$wen_travel_description = get_theme_mod( 'wen_travel_portfolio_description' );

if ( ! $wen_travel_title && ! $wen_travel_description ) {
	$classes[] = 'no-section-heading';
}

$classes[] = 'layout-three';
$classes[] = 'page';
$classes[] = 'section';
?>

<div id="portfolio-content-section" class="portfolio-content-section <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
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

		<div class="section-content-wrapper portfolio-content-wrapper layout-three">
			<div class="grid">
				<?php get_template_part( 'template-parts/portfolio/post-types', 'portfolio' ); ?>
			</div><!-- .grid -->
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #portfolio-section -->
