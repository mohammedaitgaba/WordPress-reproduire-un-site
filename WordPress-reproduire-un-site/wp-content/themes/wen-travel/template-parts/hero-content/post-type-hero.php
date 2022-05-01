<?php
/**
 * The template used for displaying hero content
 *
 * @package WEN_Travel
 */

$wen_travel_type = get_theme_mod( 'wen_travel_hero_content_type', 'page' );

$wen_travel_id = get_theme_mod( 'wen_travel_hero_content' );
$args['page_id'] = absint( $wen_travel_id );

$args['posts_per_page']      = 1;
$args['ignore_sticky_posts'] = true;

// If $args is empty return false
if ( empty( $args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$hero_query = new WP_Query( $args );
if ( $hero_query->have_posts() ) :
	while ( $hero_query->have_posts() ) :
		$hero_query->the_post();

		$classes[] = 'hero-section';
		$classes[] = 'section';
		$classes[] = 'content-align-right';
		$classes[] = 'text-align-left';

		if ( ! has_post_thumbnail() ) {
			$classes[] = 'content-full-width';
		}

		if ( ! has_post_thumbnail() ) {
			$classes[] = 'no-thumb';
		}
		?>
		<div id="hero-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="wrapper">
				<div class="section-content-wrapper hero-content-wrapper">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<?php if ( has_post_thumbnail() ) : ?>
							<div class="thumb-video-wrapper">
								<a class="cover-link" href="<?php the_permalink(); ?>">
								<?php wen_travel_post_thumbnail( 'full-image', 'html-with-bg' ); // wen_travel_post_thumbnail( $image_size, $wen_travel_type = 'html', $echo = true, $no_thumb = false ). ?>
								</a>

							</div><!-- .thumb-video-wrapper -->
							<?php endif; ?>

							<div class="entry-container">
							<?php $wen_travel_description = get_theme_mod( 'wen_travel_hero_content_description' ); ?>

							<header class="entry-header">
								<h2 class="section-title">
									<?php the_title(); ?>
								</h2>
							</header><!-- .entry-header -->


							<?php if ( $wen_travel_description ) : ?>
								<div class="section-description">
									<p>
										<?php
										echo wp_kses_post( $wen_travel_description );
										?>
									</p>
								</div><!-- .section-description-wrapper -->
							<?php endif; ?>

							<div class="entry-content">
								<?php
									the_content();									

									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wen-travel' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span class="page-number">',
										'link_after'  => '</span>',
										'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'wen-travel' ) . ' </span>%',
										'separator'   => '<span class="screen-reader-text">, </span>',
									) );
								?>
							</div><!-- .entry-content -->

							<?php if ( get_edit_post_link() ) : ?>
								<footer class="entry-footer">
									<div class="entry-meta">
										<?php
											edit_post_link(
												sprintf(
													/* translators: %s: Name of current post */
													esc_html__( 'Edit %s', 'wen-travel' ),
													the_title( '<span class="screen-reader-text">"', '"</span>', false )
												),
												'<span class="edit-link">',
												'</span>'
											);
										?>
									</div>	<!-- .entry-meta -->
								</footer><!-- .entry-footer -->
							<?php endif; ?>
						</div><!-- .hentry-inner -->
					</article>
				</div><!-- .section-content-wrapper -->
			</div><!-- .wrapper -->
		</div><!-- .section -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
