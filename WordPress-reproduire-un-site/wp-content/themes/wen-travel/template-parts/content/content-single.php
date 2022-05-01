<?php
/**
 * Template part for displaying posts
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
			<?php the_title( '<h1 class="section-title">', '</h1>' ); ?>

			<?php
			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php wen_travel_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

	<?php endif; ?>
	<?php wen_travel_single_image(); ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wen-travel' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wen-travel' ),
				'after'  => '</span></div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php wen_travel_entry_footer(); ?>
		</div><!-- .entry-meta -->

		<?php wen_travel_author_bio(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
