<?php

/**
 * About setup
 *
 * @package PortfolioX
 */

require_once trailingslashit(get_template_directory()) . 'inc/about/class.about.php';

if (!function_exists('portfoliox_about_setup')) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function portfoliox_about_setup()
	{
		$theme = wp_get_theme();
		$xtheme_name = $theme->get('Name');
		$xtheme_domain = $theme->get('TextDomain');
		if ($xtheme_domain == 'x-magazine') {
			$theme_slug = $xtheme_domain;
		} else {
			$theme_slug = 'portfoliox';
		}



		$config = array(
			// Menu name under Appearance.
			'menu_name'               => sprintf(esc_html__('%s Info', 'portfoliox'), $xtheme_name),
			// Page title.
			'page_name'               => sprintf(esc_html__('%s Info', 'portfoliox'), $xtheme_name),
			/* translators: Main welcome title */
			'welcome_title'         => sprintf(esc_html__('Welcome to %s! - Version ', 'portfoliox'), $theme['Name']),
			// Main welcome content
			// Welcome content.
			'welcome_content' => sprintf(esc_html__('%1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Thanks for using our theme!', 'portfoliox'), $theme['Name']),

			// Tabs.
			'tabs' => array(
				'getting_started' => esc_html__('Getting Started', 'portfoliox'),
				'recommended_actions' => esc_html__('Recommended Actions', 'portfoliox'),
				'useful_plugins'  => esc_html__('Useful Plugins', 'portfoliox'),
				'free_pro'  => esc_html__('Free Vs Pro', 'portfoliox'),
			),

			// Quick links.
			'quick_links' => array(
				'xmagazine_url' => array(
					'text'   => esc_html__('UPGRADE PortfolioX PRO', 'portfoliox'),
					'url'    => 'https://wpthemespace.com/product/portfoliox-pro/?add-to-cart=5925',
					'button' => 'danger',
				),
				'update_url' => array(
					'text'   => esc_html__('PortfoliX PRO Video', 'portfoliox'),
					'url'    => 'https://www.youtube.com/watch?v=pNlm-ArOHTM&t=18s',
					'button' => 'danger',
				),

			),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__('Demo Content', 'portfoliox'),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf(esc_html__('Demo content is pro feature. To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'portfoliox'), esc_html__('One Click Demo Import', 'portfoliox')),
					'button_text' => esc_html__('UPGRADE For  Demo Content', 'portfoliox'),
					'button_url'  => 'https://wpthemespace.com/product/portfoliox-pro/?add-to-cart=5925',
					'button_type' => 'primary',
					'is_new_tab'  => true,
				),

				'two' => array(
					'title'       => esc_html__('Theme Options', 'portfoliox'),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__('Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'portfoliox'),
					'button_text' => esc_html__('Customize', 'portfoliox'),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
				),
				'three' => array(
					'title'       => esc_html__('Show Video', 'portfoliox'),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf(esc_html__('You may show PortfolioX short video for better understanding', 'portfoliox'), esc_html__('One Click Demo Import', 'portfoliox')),
					'button_text' => esc_html__('Show video', 'portfoliox'),
					'button_url'  => 'https://www.youtube.com/watch?v=pNlm-ArOHTM&t=18s',
					'button_type' => 'primary',
					'is_new_tab'  => true,
				),
				'five' => array(
					'title'       => esc_html__('Set Widgets', 'portfoliox'),
					'icon'        => 'dashicons dashicons-tagcloud',
					'description' => esc_html__('Set widgets in your sidebar, Offcanvas as well as footer.', 'portfoliox'),
					'button_text' => esc_html__('Add Widgets', 'portfoliox'),
					'button_url'  => admin_url() . '/widgets.php',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'six' => array(
					'title'       => esc_html__('Theme Preview', 'portfoliox'),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__('You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized. Theme demo only work in pro theme', 'portfoliox'),
					'button_text' => esc_html__('View Demo', 'portfoliox'),
					'button_url'  => 'https://px.wpteamx.com/demos',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'seven' => array(
					'title'       => esc_html__('Contact Support', 'portfoliox'),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__('Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'portfoliox'),
					'button_text' => esc_html__('Contact Support', 'portfoliox'),
					'button_url'  => 'https://wpthemespace.com/support/',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
			),

			'useful_plugins'        => array(
				'description' => esc_html__('Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'portfoliox'),
				'already_activated_message' => esc_html__('Already activated', 'portfoliox'),
				'version_label' => esc_html__('Version: ', 'portfoliox'),
				'install_label' => esc_html__('Install and Activate', 'portfoliox'),
				'activate_label' => esc_html__('Activate', 'portfoliox'),
				'deactivate_label' => esc_html__('Deactivate', 'portfoliox'),
				'content'                   => array(
					array(
						'slug' => 'magical-addons-for-elementor',
						'icon' => 'svg',
					),
					array(
						'slug' => 'magical-products-display'
					),
					array(
						'slug' => 'magical-posts-display'
					),
					array(
						'slug' => 'click-to-top'
					),
					array(
						'slug' => 'gallery-box',
						'icon' => 'svg',
					),
					array(
						'slug' => 'magical-blocks'
					),
					array(
						'slug' => 'easy-share-solution',
						'icon' => 'svg',
					),
					array(
						'slug' => 'wp-edit-password-protected',
						'icon' => 'svg',
					),
				),
			),
			// Required actions array.
			'recommended_actions'        => array(
				'install_label' => esc_html__('Install and Activate', 'portfoliox'),
				'activate_label' => esc_html__('Activate', 'portfoliox'),
				'deactivate_label' => esc_html__('Deactivate', 'portfoliox'),
				'content'            => array(
					'magical-blocks' => array(
						'title'       => __('Magical Posts Display', 'portfoliox'),
						'description' => __('Now you can add or update your site elements very easily by Magical Products Display. Supercharge your Elementor block with highly customizable Magical Blocks For WooCommerce.', 'portfoliox'),
						'plugin_slug' => 'magical-products-display',
						'id' => 'magical-posts-display'
					),
					'go-pro' => array(
						'title'       => '<a target="_blank" class="activate-now button button-danger" href="https://wpthemespace.com/product/portfoliox-pro/?add-to-cart=5925">' . __('UPGRADE PortfolioX PRO', 'portfoliox') . '</a>',
						'description' => __('You will get more frequent updates and quicker support with the Pro version.', 'portfoliox'),
						//'plugin_slug' => 'x-instafeed',
						'id' => 'go-pro'
					),

				),
			),
			// Free vs pro array.
			'free_pro'                => array(
				'free_theme_name'     => $xtheme_name,
				'pro_theme_name'      => $xtheme_name . __(' Pro', 'portfoliox'),
				'pro_theme_link'      => 'https://wpthemespace.com/product/portfoliox-pro',
				/* translators: View link */
				'get_pro_theme_label' => sprintf(__('Get %s', 'portfoliox'), 'PortfolioX Pro'),
				'features'            => array(
					array(
						'title'       => esc_html__('Daring Design for Devoted Readers', 'portfoliox'),
						'description' => esc_html__('PortfolioX\'s design helps you stand out from the crowd and create an experience that your readers will love and talk about. With a flexible home page you have the chance to easily showcase appealing content with ease.', 'portfoliox'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Mobile-Ready For All Devices', 'portfoliox'),
						'description' => esc_html__('PortfolioX makes room for your readers to enjoy your articles on the go, no matter the device their using. We shaped everything to look amazing to your audience.', 'portfoliox'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Home slider', 'portfoliox'),
						'description' => esc_html__('PortfolioX gives you extra slider feature. You can create awesome home slider in this theme.', 'portfoliox'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Widgetized Sidebars To Keep Attention', 'portfoliox'),
						'description' => esc_html__('PortfolioX comes with a widget-based flexible system which allows you to add your favorite widgets over the Sidebar as well as on offcanvas too.', 'portfoliox'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Auto Set-up Feature', 'portfoliox'),
						'description' => esc_html__('You can import demo site only one click so you can setup your site like demo very easily.', 'portfoliox'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Multiple Header Layout', 'portfoliox'),
						'description' => esc_html__('PortfolioX gives you extra ways to showcase your header with miltiple layout option you can change it on the basis of your requirement', 'portfoliox'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('One Click Demo install', 'portfoliox'),
						'description' => esc_html__('You can import demo site only one click so you can setup your site like demo very easily.', 'portfoliox'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Extra Drag and drop support', 'portfoliox'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advanced Portfolio Filter', 'portfoliox'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Testimonial Carousel', 'portfoliox'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Diffrent Style Blog', 'portfoliox'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Flexible Home Page Design', 'portfoliox'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Pro Service Section', 'portfoliox'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Animation Home Text', 'portfoliox'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advance Customizer Options', 'portfoliox'),
						'description' => esc_html__('Advance control for each element gives you different way of customization and maintained you site as you like and makes you feel different.', 'portfoliox'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advance Pagination', 'portfoliox'),
						'description' => esc_html__('Multiple Option of pagination via customizer can be obtained on your site like Infinite scroll, Ajax Button On Click, Number as well as classical option are available.', 'portfoliox'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),

					array(
						'title'       => esc_html__('Premium Support and Assistance', 'portfoliox'),
						'description' => esc_html__('We offer ongoing customer support to help you get things done in due time. This way, you save energy and time, and focus on what brings you happiness. We know our products inside-out and we can lend a hand to help you save resources of all kinds.', 'portfoliox'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('No Credit Footer Link', 'portfoliox'),
						'description' => esc_html__('You can easily remove the Theme: PortfolioX by PortfolioX copyright from the footer area and make the theme yours from start to finish.', 'portfoliox'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
				),
			),

		);

		portfoliox_About::init($config);
	}

endif;

add_action('after_setup_theme', 'portfoliox_about_setup');


//Admin notice 
function portfoliox_new_optins_texts()
{
	global $pagenow;
	if (get_option('portfolioxfit5') || $pagenow == 'themes.php') {
		return;
	}
	$class = 'eye-notice notice notice-warning is-dismissible';
	$message = __('<strong> Hi Buddy!! Now You are using the Free version of PortfolioX theme.<br> PortfolioX PRO version is now available with an auto-setup feature!! Only active the theme and follow auto-setup then your site will be ready with lots of advanced features. Now create your site like a pro with only a few clicks!!!! So why late get pro now </strong> ', 'portfoliox');
	$url1 = esc_url('https://wpthemespace.com/product/portfoliox-pro/');
	$url3 = esc_url('https://wpthemespace.com/product/portfoliox-pro/?add-to-cart=5925');

	printf('<div class="%1$s" style="padding:10px 15px 20px;text-transform:uppercase"><p>%2$s</p><a target="_blank" class="button button-primary" href="%3$s" style="margin-right:10px">' . __('PortfolioX Pro Details', 'portfoliox') . '</a><a target="_blank" class="button button-primary" href="%4$s" style="margin-right:10px">' . __('Upgrade Pro', 'portfoliox') . '</a><button class="button button-info btnend" style="margin-left:10px">' . __('Dismiss the notice', 'portfoliox') . '</button></div>', esc_attr($class), wp_kses_post($message), $url1, $url3);
}
add_action('admin_notices', 'portfoliox_new_optins_texts');

function portfoliox_new_optins_texts_init()
{
	if (isset($_GET['xbnotice']) && $_GET['xbnotice'] == 1) {
		delete_option('portfolioxfit4');
		update_option('portfolioxfit5', 1);
	}
}
add_action('init', 'portfoliox_new_optins_texts_init');
