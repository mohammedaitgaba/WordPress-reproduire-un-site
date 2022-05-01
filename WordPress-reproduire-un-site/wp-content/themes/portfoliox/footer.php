<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PortfolioX
 */

?>

	<footer id="colophon" class="site-footer pt-3 pb-3">
		<div class="container">
			<div class="site-info text-center">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'portfoliox' ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'portfoliox' ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
				<?php
                    /* translators: 1: Theme name, 2: Theme author. */
                    printf(esc_html__('%1$s by %2$s.', 'portfoliox'), '<a href="https://wpthemespace.com/product/portfoliox/">PortfolioX</a>', 'Wp Theme Space');
                ?>
					
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
