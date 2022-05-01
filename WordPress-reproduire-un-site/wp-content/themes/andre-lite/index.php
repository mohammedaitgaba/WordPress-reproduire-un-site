<?php
/**
 * The main template file.
 *
 * @package andre
 */

get_header(); ?>

<div id="wrapper">
	<div class="innerwrapper">
			<div id="contentwrapper" class="content">
				<?php if ( have_posts() ) : ?>
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'content', get_post_format() );
					endwhile;
					?>
					<?php the_posts_pagination(); ?>
				<?php else : ?>
					<p class="center">
						<?php esc_html_e( 'You don&#39;t have any posts yet.', 'andre-lite' ); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
</div>
<?php get_footer(); ?>
