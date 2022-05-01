<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package andre
 */

get_header(); ?>

<div id="wrapper">
	<div class="innerwrapper">
		<div id="contentwrapper" class="content">
			<h1 class="entry-title">
				<?php esc_html_e( 'Oops! That page can&rsquo;t be found', 'andre-lite' ); ?>
			</h1>
			<h2 class="fourzerofour">404</h2>
			<?php get_search_form(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
