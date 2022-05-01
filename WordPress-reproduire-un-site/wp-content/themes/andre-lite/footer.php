<?php
/**
 * The template for displaying the footer.
 *
 * @package andre-lite
 */

?>

<div id="footer">
				<div class="copyinfo">
					<?php if ( get_theme_mod( 'copyright_text' ) == '' ) : ?>
						&copy; <?php echo esc_html( date_i18n( __( 'Y', 'andre-lite' ) ) ); ?> <?php bloginfo( 'name' ); ?>. <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'andre-lite' ) ); ?>">
						<?php
						/* translators: %s: Powered by */
						printf( esc_html__( 'Powered by %s.', 'andre-lite' ), 'WordPress' );
						?>
						</a>
						<?php
						/* translators: %1$s: Theme by */
						printf( esc_html__( 'Theme by %1$s.', 'andre-lite' ), '<a href="https://vivathemes.com/" rel="designer">Viva Themes</a>' );
						?>
					<?php else : ?>
							<?php echo wp_kses_post( get_theme_mod( 'copyright_text', '' ) ); ?>
					<?php endif ?>
				</div>
	</div>
	</div>
<?php wp_footer(); ?>
</body></html>
