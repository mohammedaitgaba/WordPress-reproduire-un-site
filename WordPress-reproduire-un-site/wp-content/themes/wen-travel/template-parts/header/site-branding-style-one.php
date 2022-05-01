<?php
/**
 * Displays header site branding
 *
 * @package WEN_Travel
 */
?>

<div id="header-content">
	<div class="wrapper">
		<div class="inner-header-content">
			<div id="primary-search-wrapper" class="menu-wrapper">
				<div class="menu-toggle-wrapper">
					<button id="social-search-toggle" class="menu-toggle search-toggle">
						<?php echo wen_travel_get_svg( array( 'icon' => 'search' ) ); echo wen_travel_get_svg( array( 'icon' => 'close' ) ); ?>
						<span class="menu-label"><?php echo esc_html_e( 'Search', 'wen-travel' ); ?></span>
					</button>
				</div><!-- .menu-toggle-wrapper -->

				<div class="menu-inside-wrapper">
					<div class="search-container">
						<?php get_search_form(); ?>
					</div>
				</div><!-- .menu-inside-wrapper -->
			</div><!-- #social-search-wrapper.menu-wrapper -->

			<div class="site-branding">
				<?php has_custom_logo() ? the_custom_logo() : ''; ?>

				<div class="site-identity">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
				</div><!-- .site-identity -->
			</div><!-- .site-branding -->

			<?php get_template_part( 'template-parts/navigation/navigation-social' );  ?>
		</div><!-- .inner-header-content -->	
	</div><!-- .wrapper -->
</div><!-- #header-content -->
