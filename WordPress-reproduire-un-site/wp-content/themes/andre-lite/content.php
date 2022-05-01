<?php
/**
 * The template for displaying posts on index view
 *
 * @package andre
 */

?>

<div <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'andre-blogthumb' ); ?>
		<?php endif ?>
	</a>
	<h2 class="entry-title" id="post-<?php the_ID(); ?>">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php the_title(); ?>
		</a>
	</h2>
	<div class="postdate">
		<?php echo get_the_date(); ?>
	</div>
	<?php the_excerpt(); ?>
</div>
