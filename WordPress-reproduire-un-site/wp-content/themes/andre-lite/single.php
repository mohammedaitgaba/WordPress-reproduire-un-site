<?php
/**
 * The Template for displaying all single posts.
 *
 * @package andre
 */

get_header(); ?>

<div id="wrapper">
			<div class="innerwrapper">
				<div id="contentwrapper" class="content">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<div <?php post_class(); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'andre-blogthumb' ); ?>
						<?php endif ?>
						<div class="entry">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<div class="postdate">
								<?php echo get_the_date(); ?>
							</div>
							<?php the_content(); ?>
							<?php
							wp_link_pages(
								array(
									'before'         => '<p><strong>' . esc_html__( 'Pages:', 'andre-lite' ) . '</strong> ',
									'after'          => '</p>',
									'next_or_number' => 'number',
								)
							);
							?>
							<?php edit_post_link(); ?>
							<?php echo wp_kses_post( get_the_tag_list( '<p class="singletags">', ' ', '</p>' ) ); ?>
							<div class="post-navigation">
								<div class="nav-previous">
									<?php previous_post_link( '%link' ); ?>
								</div>
								<div class="nav-next">
									<?php next_post_link( '%link' ); ?>
								</div>
							</div>
							<?php comments_template(); ?>
						</div>
					</div>
				<?php endwhile; // end of the loop. ?>
			</div>
	</div>
</div>
<?php get_footer(); ?>
