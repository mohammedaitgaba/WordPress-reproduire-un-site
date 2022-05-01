<?php
/**
 * The file for header all actions
 *
 *
 * @package PortfolioX
 */

function portfoliox_header_menu_output(){
?>
		<nav id="site-navigation" class="main-navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'main-menu',
					'menu_id'        => 'portfoliox-menu',
					'menu_class'        => 'portfoliox-menu',
				) );
			?>
		</nav><!-- #site-navigation -->	
<?php
}
add_action('portfoliox_main_menu','portfoliox_header_menu_output');


function portfoliox_header_logo_output(){
	$portfoliox_site_tagline_show = get_theme_mod('portfoliox_site_tagline_show');

?>

					<?php if(has_custom_logo()): ?>
						<div class="site-branding brand-logo">
							<?php
								the_custom_logo();
							?>
						</div>
					<?php endif; ?>
					<?php
				if(display_header_text() == true || (display_header_text() == true && is_customize_preview()) ): ?>
					<div class="site-branding brand-text">
							<?php if (display_header_text() == true || (display_header_text() == true && is_customize_preview()) ): ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
								$portfoliox_description = get_bloginfo( 'description', 'display' );
								if( ($portfoliox_description || is_customize_preview()) && empty($portfoliox_site_tagline_show) ) :
									?>
									<p class="site-description"><?php echo $portfoliox_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
								<?php endif; ?>	
							<?php endif; ?>	

					</div><!-- .site-branding -->
					<?php endif; ?>

<?php
}
add_action('portfoliox_header_logo','portfoliox_header_logo_output');




// header style one
function portfoliox_header_style_one(){
?>
	<div class="container-fluid pxm-style1">
        <div class="navigation mx-4">
            <div class="d-flex">
                <div class="pxms1-logo">
                  <?php do_action('portfoliox_header_logo'); ?>
                </div>
                <div class="pxms1-menu ms-auto">
                  <?php do_action('portfoliox_main_menu'); ?>
				</div>
            </div>
        </div>
    </div>


<?php
}
add_action('portfoliox_header_style_one','portfoliox_header_style_one');

// header style one
function portfoliox_header_style_two(){
	
?>
	<div class="portfoliox-logo-section">
		<div class="container">
			<div class="head-logo-sec">
				<?php do_action('portfoliox_header_logo'); ?>
			</div>
		</div>
	</div>

	<div class="menu-bar text-center">
		<div class="container">
			<div class="portfoliox-container menu-inner">
				<?php do_action( 'portfoliox_main_menu'); ?>
			</div>
		</div>
	</div>
<?php
}
add_action('portfoliox_header_style_two','portfoliox_header_style_two');


