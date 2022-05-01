<?php
/**
 * The Header for our theme.
 *
 * @package andre
 */

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=2.0, user-scalable=yes" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	?>
	<div class="overlay">
	<button class="menu-button">
		<span class="bar3"></span>
	</button>
	<div class="overlayleft">

		<?php
		if ( has_nav_menu( 'main-menu' ) ) {
			wp_nav_menu(
				array(
					'theme_location'  => 'main-menu',
					'container_class' => 'mainmenu',
					'menu_class'      => '',
					'fallback_cb'     => false,
				)
			);
		}
		?>
	</div>
	<div class="overlayright">
		<?php get_sidebar(); ?>
	</div>
</div>
	<div id="container" class="allcontainer">
		<div class="slogan">
			<h2 class="site-description">
				<?php bloginfo( 'description' ); ?>
			</h2>
		</div>

		<?php
		if ( has_nav_menu( 'social' ) ) {
					wp_nav_menu(
						array(
							'theme_location'  => 'social',
							'container'       => 'div',
							'container_id'    => 'menu-social',
							'container_class' => 'menu',
							'menu_id'         => 'menu-social-items',
							'menu_class'      => 'menu-items',
							'depth'           => 1,
							'link_before'     => '<span class="screen-reader-text">',
							'link_after'      => '</span>',
							'fallback_cb'     => '',
						)
					); }
		?>

		<div id="header">
				<div id="logo">
					<?php the_custom_logo(); ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<h1 class="site-title">
							<?php bloginfo( 'name' ); ?>
						</h1>
					</a>
				</div>
		</div>
