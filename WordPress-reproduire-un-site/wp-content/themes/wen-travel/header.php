<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WEN_Travel
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<?php
/**
 * Moving default Store Notice from bottom to this position.
 */
if ( function_exists( 'woocommerce_demo_store' ) ) {
	woocommerce_demo_store();
}
?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wen-travel' ); ?></a>

	<?php get_template_part( 'template-parts/header/masthead' ); ?>

	<?php wen_travel_sections(); ?>

	<div id="content" class="site-content">
		<div class="wrapper">
	
