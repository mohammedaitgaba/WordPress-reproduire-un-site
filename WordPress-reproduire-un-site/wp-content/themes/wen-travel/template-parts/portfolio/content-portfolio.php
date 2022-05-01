<?php
/**
 * The template used for displaying projects on index view
 *
 * @package WEN_Travel
 */

global $post;

?>

<article id="portfolio-post-<?php the_ID(); ?>" <?php post_class( 'grid-item' ); ?>>
	<div class="hentry-inner">
		<?php 
		if( has_post_thumbnail() ) {
			wen_travel_post_thumbnail( 'wen-travel-archive', 'html', true, true );
		} else {
			wen_travel_post_thumbnail( array(666, 666), 'html', true, true );
		} ?>
		
		<div class="entry-container caption">
			<div class="entry-container-inner-wrap">
				<header class="entry-header">
				<div class="entry-price">	
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				</div>
				</header>
			</div><!-- .entry-container-inner-wrap -->	
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
