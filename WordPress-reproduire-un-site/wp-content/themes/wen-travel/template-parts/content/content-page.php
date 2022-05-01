<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WEN_Travel
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		$header_image = wen_travel_featured_overall_image();

		if ( 'disable' === $header_image ) : ?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title section-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		<?php endif; ?>
		
	<?php wen_travel_single_image(); ?>

	<div class="entry-content">

		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wen-travel' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<div class="entry-meta">
				<?php
					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'wen-travel' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						),
						'<span class="edit-link">',
						'</span>'
					);
				?>
			</div><!-- .entry-meta -->
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
