<?php
/**
 * Admin functions.
 *
 * @package Wen Travel
 */

add_action( 'admin_menu', 'wen_travel_admin_menu_page' );

/**
 * Register admin page.
 *
 * @since 1.0.0
 */
function wen_travel_admin_menu_page() {

	$theme = wp_get_theme( get_template() );

	add_theme_page(
		$theme->display( 'Name' ),
		$theme->display( 'Name' ),
		'manage_options',
		'wen-travel',
		'wen_travel_do_admin_page'
	);

}

/**
 * Render admin page.
 *
 * @since 1.0.0
 */
function wen_travel_do_admin_page() {

	$theme = wp_get_theme( get_template() );
	?>
	<div class="wrap about-wrap">
		<h1><?php echo $theme->display( 'Name' ); ?></h1>
		<div class="two-col">

			<div class="col about-text">
				<?php
					$description_raw = $theme->display( 'Description' );
					$main_description = explode( 'Official', $description_raw );
					?>
				<?php echo wp_kses_post( $main_description[0] ); ?>
				<p><?php esc_html_e( 'Version', 'wen-travel' ); ?>:&nbsp;<?php echo esc_html( $theme->display( 'Version' ) ); ?></p>
			</div><!-- .col -->

			<div class="col about-img">
				<a href="<?php echo esc_url( $theme->display( 'ThemeURI' ) ); ?>" target="_blank"><img src="<?php echo trailingslashit( get_template_directory_uri() ); ?>screenshot.png" alt="<?php echo esc_attr( $theme->display( 'Name' ) ); ?>" /></a>
			</div><!-- .col -->

		</div><!-- .two-col -->
		<div class="four-col">

			<div class="col">

				<h3><i class="dashicons dashicons-admin-customizer"></i><?php esc_html_e( 'Theme Options', 'wen-travel' ); ?></h3>

				<p>
					<?php esc_html_e( 'We have used Customizer API for theme options which will help you preview your changes live and fast.', 'wen-travel' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo wp_customize_url(); ?>" ><?php esc_html_e( 'Customize', 'wen-travel' ); ?></a>
				</p>

			</div><!-- .col -->

			<div class="col">

				<h3><i class="dashicons dashicons-book-alt"></i><?php esc_html_e( 'Theme Instructions', 'wen-travel' ); ?></h3>
				<p>
					<?php esc_html_e( 'We have prepared detailed theme instructions which will help you to customize theme as you prefer.', 'wen-travel' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_url( 'https://themepalace.com/instructions/themes/wen-travel/' ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'wen-travel' ); ?></a>
				</p>

			</div><!-- .col -->


			<div class="col">

				<h3><i class="dashicons dashicons-sos"></i><?php esc_html_e( 'Help &amp; Support', 'wen-travel' ); ?></h3>

				<p>
					<?php esc_html_e( 'If you have any question/feedback regarding theme, please post in our official support forum.', 'wen-travel' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_url( 'https://themepalace.com/forum/free-themes/wen-travel/' ); ?>" target="_blank"><?php esc_html_e( 'Get Support', 'wen-travel' ); ?></a>
				</p>

			</div><!-- .col -->

		</div><!-- .four-col -->


	</div><!-- .wrap -->
	<?php

}

/**
 * Load admin scripts.
 *
 * @since 1.0.0
 *
 * @param string $hook Current page hook.
 */
function wen_travel_load_admin_scripts( $hook ) {

	if ( 'appearance_page_wen-travel' === $hook ) {

		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_style( 'wen-travel-admin', get_template_directory_uri() . '/css/admin' . $min . '.css', false, '2.1.0' );

	}

}

add_action( 'admin_enqueue_scripts', 'wen_travel_load_admin_scripts' );
