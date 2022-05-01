<?php
/**
 * Displays Social Navigation
 *
 * @package WEN_Travel
 */

if ( has_nav_menu( 'social-menu' ) ) :  ?>
	<div id="social-menu-wrapper" class="menu-wrapper show-in-desktop">
		<div class="menu-toggle-wrapper">
			<button id="share-toggle" class=" menu-toggle toggle-top share-toggle">
				<?php echo wen_travel_get_svg( array( 'icon' => 'share' ) ); echo wen_travel_get_svg( array( 'icon' => 'close' ) ); ?><span class="share-label screen-reader-text"><?php esc_html_e( 'Social Menu', 'wen-travel' ); ?></span></button>
		</div><!-- .menu-toggle-wrapper -->

		<div class="menu-inside-wrapper">
			<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Menu', 'wen-travel' ); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' 	=> 'social-menu',
						'menu_class'     	=> 'social-links-menu',
						'container'			=> 'div',
						'container_class'	=> 'menu-social-container',
						'depth'          	=> 1,
						'link_before'    	=> '<span class="screen-reader-text">',
						'link_after'       => '</span>' . wen_travel_get_svg( array( 'icon' => 'chain' ) ),
					) );
				?>
			</nav><!-- .social-navigation -->
		</div><!-- .menu-inside-wrapper -->
	</div><!-- .menu-wrapper -->
<?php endif; ?>
