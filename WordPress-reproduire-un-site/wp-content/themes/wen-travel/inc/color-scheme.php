<?php
/**
 * Customizer functionality
 *
 * @package Zubin
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since 1.0
 *
 * @see wen_travel_header_style()
 */
function wen_travel_custom_header_and_bg() {
	$color_scheme       = wen_travel_get_color_scheme();
	$default_text_color = trim( $color_scheme['header_textcolor'], '#' );

	/**
	 * Filter the arguments used when adding 'custom-background' support in Zubin.
	 *
	 * @since 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'wen_travel_custom_bg_args', array(
		'default-color' => '#ffffff',
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Zubin.
	 *
	 * @since 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'wen_travel_custom_header_args', array(
		'default-image'      => get_parent_theme_file_uri( '/images/header-image.jpg' ),
		'default-text-color' => $default_text_color,
		'width'              => 1920,
		'height'             => 1080,
		'flex-height'        => true,
		'flex-height'        => true,
		'wp-head-callback'   => 'wen_travel_header_style',
		'video'              => true,
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/images/header-image.jpg',
			'thumbnail_url' => '%s/images/header-image-275x155.jpg',
			'description'   => esc_html__( 'Default Header Image', 'wen-travel-pro' ),
		)
	) );
}
add_action( 'after_setup_theme', 'wen_travel_custom_header_and_bg' );

function wen_travel_color_options() {
	// We do not add Background Color and Header Text Color here as if comes from WordPress Core.
	$color_options = array(
		'primary_background_color'            => array(
			'label'   => 	esc_html__( 'Primary Background Color', 'wen-travel-pro' ),
			'css'     =>	'input[type="text"],
							input[type="email"],
							input[type="url"],
							input[type="password"],
							input[type="search"],
							input[type="number"],
							input[type="tel"],
							input[type="range"],
							input[type="date"],
							input[type="month"],
							input[type="week"],
							input[type="time"],
							input[type="datetime"],
							input[type="datetime-local"],
							input[type="color"],
							textarea,
							select,
							.custom-header-form,
							.section:nth-child(even) + .portfolio-content-section.itineraries .portfolio-content-wrapper .hentry-inner .entry-container,
							.section:nth-child(even) + .portfolio-content-section.destination .portfolio-content-wrapper .hentry-inner .entry-container,
							.section:nth-child(even) + .featured-content-section .hentry-inner .entry-container,
							.section:nth-child(even) + .latest-package-section .latest-package-wrapper .hentry-inner .button-wrap,
							.section:nth-child(even)+.team-content-section .hentry-inner:before,
							.section:nth-child(even)+.service-section .hentry-inner,
							.section:nth-child(even)+.featured-trip-section .hentry .entry-container,
							.section:nth-child(even)+#contact-section .entry-container .inner-container,
							.section:nth-child(even)+#testimonial-content-section .section-content-wrapper .hentry-inner .entry-content,
							.section:nth-child(even)+#testimonial-content-section .section-content-wrapper .hentry-inner .entry-summary,
							.home .header-media.content-frame .custom-header-content,
							.demo_store .woocommerce-store-notice__dismiss-link,
							.promotion-headline-wrapper.section .section-content-wrap .inner-container .more-button .more-link:hover,
							.promotion-headline-wrapper.section .section-content-wrap .inner-container .more-button .more-link:focus,
							.select2-container--default .select2-selection--single,
							.screen-reader-text:focus,
							.boxed-layout .site,
							.why-choose-us-section .hentry .entry-container,
							.ui-state-active,
							.transparent-header.navigation-classic .main-navigation a:before,
							.site-header-cart .cart-contents .count,
							.ui-widget-content .ui-state-active,
							.ui-widget-header .ui-state-active,
							.featured-content-wrapper .hentry-inner {
								background-color: %1$s;
							}
	
							.section:nth-child(even)+.testimonial-content-section .entry-content:after,
							.section:nth-child(even)+.team-content-section .team-content-wrapper.section-content-wrapper .hentry-inner .post-thumbnail img {
								border-color: %1$s;
							}',
		),
		'secondary_background_color'             => array(
			'label'   => 	esc_html__( 'Secondary Background Color', 'wen-travel-pro' ),
			'css'     => 	'#site-header-top-menu,
							.comment-container,
							.section:nth-child(odd),
							.gallery-caption,
							.wp-block-archives li span::after,
							.wp-block-categories li span::after,
							.sidebar .widget_categories ul li span::after, 
							.sidebar .widget_archive ul li span::after,
							.tiled-gallery-item .tiled-gallery-caption,
							.portfolio-content-section.itineraries .portfolio-content-wrapper .entry-container,
							.portfolio-content-section.destination .portfolio-content-wrapper .entry-container,
							.section:nth-child(odd) + .portfolio-content-section.itineraries .portfolio-content-wrapper .hentry-inner .entry-container,
							.section:nth-child(odd) + .portfolio-content-section.destination .portfolio-content-wrapper .hentry-inner .entry-container,
							.section:nth-child(odd) + .featured-content-section .hentry-inner .entry-container,
							.section:nth-child(odd)+.service-section .hentry-inner,
							.section:nth-child(odd)+.team-content-section .hentry-inner:before,
							.section:nth-child(odd)+.featured-trip-section .hentry .entry-container,
							.section:nth-child(odd)+#testimonial-content-section .section-content-wrapper .hentry-inner .entry-content,
							.section:nth-child(odd)+#testimonial-content-section .section-content-wrapper .hentry-inner .entry-summary,
							.section:nth-child(odd)+#contact-section .entry-container .inner-container,
							.footer-newsletter input:not([type="submit"]),
							.custom-header-form input:not([type="submit"]),
							.custom-header-form textarea,
							.team-content-wrapper .entry-container,
							.skill-section .section-content-wrapper,
							.promotion-section,
							.why-choose-us-section,
							#primary-search-wrapper .menu-inside-wrapper,
							.menu-inside-wrapper,
							.mobile-social-search,
							mark,
							.custom-header,
							ul.tabs.wc-tabs li.active a,
							.woocommerce-Tabs-panel,
							.shop_table thead th,
							ul.wc_payment_methods.payment_methods.methods li,
							.comment-respond,
							.site-header-cart .widget_shopping_cart,
							pre,
							.widget .ui-tabs .ui-tabs-panel,
							.wp-block-pullquote.is-style-solid-color,
							.wp-block-table.is-style-stripes tbody tr:nth-child(odd),
							.section:nth-child(odd)+.testimonial-content-section .entry-content,
							.latest-package-wrapper .hentry-inner .button-wrap,
							.wp-travel-default-article .wp-travel-entry-content-wrapper .description-right,
							.wp-travel-itinerary-items .wp-travel-post-wrap-bg,
							.wp-travel-itinerary-items ul.wp-travel-itinerary-list.itinerary-3-per-row li,
							.wp-travel-related-posts .wp-travel-itinerary-items .wp-travel-itinerary-list[class*="itinerary-"] li {
								background-color: %1$s;
							}

							.section:nth-child(odd)+.testimonial-content-section .entry-content:after,
							.section:nth-child(odd)+.team-content-section .team-content-wrapper.section-content-wrapper .hentry-inner .post-thumbnail img {
								border-color: %1$s;
							}

							@media screen and (min-width: 568px) {
								.comment-body .comment-container:before {
									border-right-color: %1$s;
								}
							}

							@media screen and (min-width: 1024px) {
								#site-header-top-menu {
									background-color: transparent;
								}
							}

							.comment-container:before {
								border-bottom-color: %1$s;
							}

							@media screen and (min-width: 1024px) {
								.navigation-classic .site-header .sub-menu,
								.navigation-classic .site-header .children {
									background-color: %1$s;
								}
							}',
		),
		'tertiary_background_color' => array(
			'label'   => 	esc_html__( 'Tertiary Background Color', 'wen-travel-pro' ),
			'css'     => 	'.header-style-one #primary-search-wrapper .menu-inside-wrapper,
							.portfolio-content-wrapper .filter-button-group button.is-checked,
							.collection-content-wrapper .filter-button-group button.button.is-checked,
							.attraction-content-wrapper .filter-button-group button.button.is-checked,
							.countdown-content-wrapper .content-right #clock {
								background-color: %1$s;
							}',
		),
		'footer_background_color' => array(
			'label'   => 	esc_html__( 'Footer Background Color', 'wen-travel-pro' ),
			'css'     => 	'#colophon {
								background-color: %1$s;
							}',
		),
		'main_text_color'          => array(
			'label'   => 	esc_html__( 'Main Text Color', 'wen-travel-pro' ),
			'css'     => 	'body,
							input,
							select,
							optgroup,
							textarea,
							blockquote,
							.list-inline li a,
							.list-inline li,
							.latest-package-wrapper .entry-header .entry-meta a,
							.latest-package-wrapper .entry-header .entry-meta,
							.wpcf7-response-output,
							.wpcf7-list-item-label,
							label,
							.job-label,
							.pagination .page-numbers.dots,
							.navigation.pagination .next,
							.navigation.pagination .previous,
							.navigation.pagination .prev,
							input,
							select,
							optgroup,
							textarea,
							.portfolio-content-section.itineraries .entry-container,
							.portfolio-content-section.destination .entry-container,
							.section-description-wrapper,
							.section-title-wrapper+.section-description,
							.section-heading-wrapper>.section-description,
							.section-title+.section-description,
							.custom-header-content-wrapper .more-link,
							.skill-section.has-background-image .entry-summary,
							.skill-section.has-background-image .entry-content,
							input[type="text"],
							input[type="email"],
							input[type="url"],
							input[type="password"],
							input[type="search"],
							input[type="number"],
							input[type="tel"],
							input[type="range"],
							input[type="date"],
							input[type="month"],
							input[type="week"],
							input[type="time"],
							input[type="datetime"],
							input[type="datetime-local"],
							input[type="color"],
							.sidebar .widget-wrap p,
							.promotion-section .play-video .play-button:hover:before,
							.promotion-section .play-video .play-button:focus:before,
							.entry-container .entry-content,
							.entry-container .entry-summary,
							.wp-block-code {
								color: %1$s;
							}
							::-moz-placeholder {
								color:  %1$s;
							}
							:-moz-placeholder {
								color:  %1$s;
							}
							::-webkit-input-placeholder {
								color:  %1$s;
							}
							
							:-ms-input-placeholder {
								color:  %1$s;
							}',
		),
		'header_navigation_color'               => array(
			'label'   => 	esc_html__( ' Header Navigation Color', 'wen-travel-pro' ),
			'css'     => 	'.transparent-header.has-header-media .menu-toggle,
							.transparent-header.slider-after-header .menu-toggle {
							    color: %1$s;
							}

							@media screen and (min-width: 1200px) { .transparent-header:not(.header-style-two).has-header-media header .social-navigation li a:hover,
								.transparent-header:not(.header-style-two).has-header-media header .social-navigation li a:focus,
								.transparent-header:not(.header-style-two).slider-after-header header .social-navigation li a:hover,
								.transparent-header:not(.header-style-two).slider-after-header header .social-navigation li a:focus,
								.transparent-header:not(.header-style-two).has-header-media header .social-navigation li a,
    							.transparent-header:not(.header-style-two).slider-after-header header .social-navigation li a,
								.transparent-header.has-header-media.has-header-image.navigation-classic .main-navigation ul:not(.sub-menu)>li>a,
   					 			.transparent-header.slider-after-header.navigation-classic .main-navigation ul:not(.sub-menu)>li>a,
								.transparent-header.has-header-media.navigation-classic .main-navigation ul:not(.children)>li>a,
   					 			.transparent-header.slider-after-header.navigation-classic .main-navigation ul:not(.children)>li>a {
									color: %1$s;
								}
							}

							@media screen and (min-width: 1024px) {
								.transparent-header.has-header-media .top-main-wrapper .header-top-right ul li a,
								.transparent-header.has-header-media .top-main-wrapper .header-top-left ul li a,
								.transparent-header.has-header-media .top-main-wrapper .header-top-left ul li,
								.transparent-header.slider-after-header .top-main-wrapper .header-top-right ul li a,
								.transparent-header.slider-after-header .top-main-wrapper .header-top-left ul li a,
								.transparent-header.slider-after-header .top-main-wrapper .header-top-left ul li {
									color: %1$s;
								}
							}
							@media screen and ( min-width: 768px ) {
								.transparent-header.has-header-media #site-header-cart-wrapper .cart-contents,
								.transparent-header.slider-after-header #site-header-cart-wrapper .cart-contents {
									color:  %1$s;
								}
							}',
		),
		'header_navigation_hover_color'               => array(
			'label'   => 	esc_html__( 'Header Navigation Hover Color', 'wen-travel-pro' ),
			'css'     => 	'	.transparent-header:not(.header-style-two).has-header-media header .social-navigation li a:hover,
								.transparent-header:not(.header-style-two).has-header-media header .social-navigation li a:focus,
								.transparent-header:not(.header-style-two).slider-after-header header .social-navigation li a:hover,
								.transparent-header:not(.header-style-two).slider-after-header header .social-navigation li a:focus,
								.transparent-header.has-header-media .menu-toggle:hover, 
								.transparent-header.has-header-media .menu-toggle:focus, 
								.transparent-header.slider-after-header .menu-toggle:hover,
								.transparent-header.slider-after-header .menu-toggle:focus,
								button.dropdown-toggle .icon:hover,
								button.dropdown-toggle .icon:focus,
								.transparent-header.has-header-media #site-header-cart-wrapper .cart-contents:hover, 
								.transparent-header.has-header-media #site-header-cart-wrapper .cart-contents:focus, 
								.transparent-header.slider-after-header #site-header-cart-wrapper .cart-contents:hover,
								.transparent-header.slider-after-header #site-header-cart-wrapper .cart-contents:focus,
								.transparent-header.slider-after-header .top-main-wrapper .header-top-right ul li a:hover,
								.transparent-header.slider-after-header .top-main-wrapper .header-top-right ul li a:focus,
								.transparent-header.slider-after-header .top-main-wrapper .header-top-left ul li a:hover,
								.transparent-header.slider-after-header .top-main-wrapper .header-top-left ul li a:focus {
									color: %1$s;
								}

								.navigation-default.transparent-header .menu-inside-wrapper .main-navigation ul > li > a:hover,
								.navigation-default.transparent-header .menu-inside-wrapper .main-navigation ul > li > a:focus,
								.transparent-header.slider-after-header.navigation-classic .main-navigation ul ul li.current_page_item>a,
								.transparent-header.has-header-media.navigation-classic .main-navigation ul ul li.current-menu-item>a {
									color: %1$s;
								}

								@media screen and ( min-width: 1024px) {
									.transparent-header.has-header-media .top-main-wrapper .header-top-right ul li a:hover,
									.transparent-header.has-header-media .top-main-wrapper .header-top-right ul li a:focus,
									.transparent-header.has-header-media .top-main-wrapper .header-top-left ul li a:hover,
									.transparent-header.has-header-media .top-main-wrapper .header-top-left ul li a:focus {
										color: %1$s;
									}
								}

								@media screen and ( min-width: 1200px ) {
									.transparent-header.slider-after-header.navigation-classic .menu-inside-wrapper .main-navigation ul li.current_page_item>a,
								    .transparent-header.has-header-media.navigation-classic .menu-inside-wrapper .main-navigation ul li.current-menu-item>a,
									.transparent-header.has-header-media.navigation-classic .main-navigation ul:not(.sub-menu):not(.children) > li.current-menu-item>a, 
									.transparent-header.slider-after-header.navigation-classic .main-navigation ul:not(.sub-menu):not(.children) > li.current-menu-item>a,
									.transparent-header.has-header-media.has-header-image.navigation-classic .menu-inside-wrapper .main-navigation ul:not(.sub-menu):not(.children) > li > a:hover,
									.transparent-header.has-header-media.has-header-image.navigation-classic .menu-inside-wrapper .main-navigation ul:not(.sub-menu):not(.children) > li > a:focus,
									.transparent-header.slider-after-header.navigation-classic .menu-inside-wrapper .main-navigation ul:not(.sub-menu):not(.children) > li > a:hover,
									.transparent-header.slider-after-header.navigation-classic .menu-inside-wrapper .main-navigation ul:not(.sub-menu):not(.children) > li > a:focus {
										color: %1$s;
									}
								}
								
								.transparent-header.navigation-classic.has-header-media .main-navigation .nav-menu > li > a::before, 
								.transparent-header.navigation-classic.slider-afer-header .main-navigation .nav-menu > li > a::before,
								.widget_categories ul li span:after, 
								.widget_archive ul li span:after,
								.featured-content-wrapper .hentry .entry-container {
									background-color: %1$s;
								}',
		),
		'non_transparent_header_text_color'               => array(
			'label'   => 	esc_html__( 'Non Transparent Header Text Color', 'wen-travel-pro' ),
			'css'     => 	'.site-title a,
							.site-description {
							    color: %1$s;
							}',
		),
		'non_transparent_nav_color'               => array(
			'label'   => 	esc_html__( 'Non Transparent Nav Color', 'wen-travel-pro' ),
			'css'     => 	'.navigation-default:not(.transparent-header) .menu-inside-wrapper .main-navigation ul > li > a,
							header .social-navigation .menu-social-container li a {
								color: %1$s;
							}

							@media screen and (min-width: 1200px) {
								.navigation-classic:not(.transparent-header) .main-navigation ul:not(.sub-menu):not(.children)> li> a {
									color: %1$s;
								}
							}

							@media screen and (min-width: 1024px) {
								header .top-main-wrapper .social-navigation li a,
								.top-main-wrapper .header-top-right ul li a,
								.top-main-wrapper .header-top-left ul li a,
								.top-main-wrapper .header-top-left ul li {
									color: %1$s;
								}
							}

							button.menu-toggle {
								color: %1$s;
							}

							@media screen and (min-width: 768px) {
								#site-header-cart-wrapper .cart-contents {
									color: %1$s;
								}
							}',
		),
		'non_transparent_nav_hover_color'               => array(
			'label'   => 	esc_html__( 'Non Transparent Nav Hover Color', 'wen-travel-pro' ),
			'css'     => 	'.navigation-classic:not(.transparent-header) .main-navigation>.nav-menu .current_page_item>a,
							.navigation-classic:not(.transparent-header) .main-navigation>.nav-menu .current-menu-item>a,
							.navigation-default:not(.transparent-header) .main-navigation>.nav-menu .current_page_item>a,
							.navigation-default:not(.transparent-header) .main-navigation>.nav-menu .current-menu-item>a,
							.navigation-default:not(.transparent-header) .menu-inside-wrapper .main-navigation ul > li > a:hover,
							.navigation-default:not(.transparent-header) .menu-inside-wrapper .main-navigation ul > li > a:focus,
							.navigation-classic:not(.transparent-header) .menu-inside-wrapper .main-navigation ul > li > a:hover,
							.navigation-classic:not(.transparent-header) .menu-inside-wrapper .main-navigation ul > li > a:focus,
							header .top-main-wrapper .social-navigation li a:focus,
							header .top-main-wrapper .social-navigation li a:hover,
							header .social-navigation .menu-social-container li a:hover,
							header .social-navigation .menu-social-container li a:focus,
							button.menu-toggle:hover,
							button.menu-toggle:focus,
							button.dropdown-toggle .icon:hover,
							button.dropdown-toggle .icon:focus,
							#site-header-cart-wrapper .cart-contents:hover,
							#site-header-cart-wrapper .cart-contents:focus,
							.top-main-wrapper .header-top-left ul li a:hover,
							.top-main-wrapper .header-top-left ul li a:focus,
							.collection-content-wrapper .filter-button-group button.button:hover,
							.collection-content-wrapper .filter-button-group button.button:focus,
							.attraction-content-wrapper .filter-button-group button.button:hover,
							.attraction-content-wrapper .filter-button-group button.button:focus {
							    color: %1$s;
							}
							
							@media screen and (min-width: 1200px){
								.navigation-classic:not(.transparent-header) .menu-inside-wrapper .main-navigation ul > li > a:hover, 
								.navigation-classic:not(.transparent-header) .menu-inside-wrapper .main-navigation ul > li > a:focus {
								color: %1$s;
								}
							}

							.navigation-classic .main-navigation .nav-menu>li>a:before {
								background-color: %1$s;
							}',
		),
		'custom_header_slider_text_color'               => array(
			'label'   => 	esc_html__( 'Custom Header Slider Text Color', 'wen-travel-pro' ),
			'css'     => 	'.has-header-image .custom-header-content-wrapper .more-link,
							.feature-slider-wrapper .entry-container .entry-title,
							.feature-slider-wrapper .entry-container .entry-title span,
							.feature-slider-wrapper .entry-container .entry-summary,
							.feature-slider-wrapper .entry-container .entry-content,
							.has-header-image .custom-header-content .site-header-text,
							.has-header-image .custom-header-content .header-media-tagline,
							.has-header-image .custom-header-content .site-header-text .entry-meta a,
							.has-header-image .custom-header-content .section-title {
							    color: %1$s;
							}',
		),
		'heading_text_color'         => array(
			'label'   => 	esc_html__( 'Heading Text Color', 'wen-travel-pro' ),
			'css'     => 	'h1,
							h2,
							h3,
							h4,
							h5,
							h6,
							.comment-respond .comment-form p label,
							.section-title,
							.portfolio-section-headline .section-title,
							.special-offer-content-wrapper .section-description {
							    color: %1$s;
							}

							ins {
								background-color: %1$s;
							}

							@media screen and (min-width: 768px) {
								.testimonials-content-wrapper.section.testimonial-wrapper .cycle-pager span,
								#site-header-cart-wrapper a.cart-contents {
									color: %1$s;
								}
							}',
		),
		'link_color'         => array(
			'label'   => 	esc_html__( 'Link Color', 'wen-travel-pro' ),
			'css'     => 	'a,
							::marker,
							.textwidget ul li .icon,
							.entry-container .amount,
							.latest-package-wrapper .amount,
							.wp-travel-default-article .wp-travel-entry-content-wrapper .description-right .trip-price ins,
							.ui-state-active a,
							.ui-state-active a:link,
							.ui-state-active a:visited,
							.left-content .price-offer .price-per-person .price,
							#wp-travel-featured-trip-section .featured-trip-content-wrapper .hentry .entry-container .amount,
							.social-search-wrapper .menu-social-container li a,
							.sidebar nav.social-navigation ul li a:hover,
							.sidebar nav.social-navigation ul li a:focus,
							.screen-reader-text:focus,
							td#today,
							.toggled-on.active:before,
							.comment-respond .comment-form p.is-focused label,
							.contact-section.section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li a,
							.nav-title,
							.post-title,
							.woocommerce.has-header-image .woocommerce-breadcrumb a:hover,
							.woocommerce.has-header-image .woocommerce-breadcrumb a:focus,
							.wp-travel-archive-content .wp-travel-default-article .wp-travel-entry-content-wrapper .description-right .wp-detail-review-wrap .wp-travel-trip-detail .trip-price span,
							.wp-travel-itinerary-items .wp-travel-post-wrap-bg .trip-price span + span,
							.wp-travel-itinerary-items .wp-travel-post-wrap-bg .trip-price .wp-travel-trip-currency {
								color: %1$s;
							}',
		),
		'link_hover_color'         => array(
			'label'   => 	esc_html__( 'Link Hover Color', 'wen-travel-pro' ),
			'css'     => 	'a:hover,
							a:focus,
							.site-title a:hover,
							.site-title a:focus,
							.site-info a:hover,
							.site-info a:focus,
							.navigation-classic .menu-inside-wrapper .main-navigation ul>li>a:hover,
							.navigation-classic .menu-inside-wrapper .main-navigation ul>li>a:focus,
							.portfolio-content-wrapper .hentry .entry-container .entry-meta time:hover,
							.portfolio-content-wrapper .hentry .entry-container .entry-meta time:focus,
							.latest-trip-section .hentry-inner .post-thumbnail .entry-header .entry-title a:hover,
							.latest-trip-section .hentry-inner .post-thumbnail .entry-header .entry-title a:focus,
							.navigation-classic .menu-inside-wrapper .main-navigation ul > li > a:hover,
							.navigation-classic .menu-inside-wrapper .main-navigation ul > li > a:focus,
							.has-background-image .portfolio-content-wrapper .filter-button-group button:not(.is-checked):hover,
							.has-background-image .portfolio-content-wrapper .filter-button-group button:not(.is-checked):focus,
							.featured-trip-section .entry-title a:hover,
							.featured-trip-section .entry-title a:focus,
							.collection-content-section .entry-title a:hover,
							.collection-content-section .entry-title a:focus,
							.attraction-content-section .entry-title a:hover,
							.attraction-content-section .entry-title a:focus,
							.featured-content-section .section-content-wrapper .post-thumbnail .entry-title a:hover,
							.featured-content-section .section-content-wrapper .post-thumbnail .entry-title a:focus,
							.collection-content-wrapper .entry-meta a:hover,
							.collection-content-wrapper .entry-meta a:focus,
							.attraction-content-wrapper .entry-meta a:hover,
							.attraction-content-wrapper .entry-meta a:focus,
							.featured-content-section .section-content-wrapper .post-thumbnail .entry-meta a:hover,
							.featured-content-section .section-content-wrapper .post-thumbnail .entry-meta a:focus,
							.top-main-wrapper .header-top-right ul li a:hover,
							.top-main-wrapper .header-top-right ul li a:focus,
							.top-main-wrapper .header-top-left ul li a:hover,
							.top-main-wrapper .header-top-left ul li a:focus,
							.play-button-text:hover,
							.play-button-text:focus,
							.wp-playlist-tracks .wp-playlist-caption:hover,
							.wp-playlist-tracks .wp-playlist-caption:focus,
							#site-header-cart-wrapper a.cart-contents:hover,
							#site-header-cart-wrapper a.cart-contents:focus,
							.woocommerce-loop-product__title:hover,
							.woocommerce-loop-product__title:focus,
							span.price span.woocommerce-Price-amount:hover,
							span.price span.woocommerce-Price-amount:focus,
							button.dropdown-toggle:hover,
							button.dropdown-toggle:focus,
							.site-header-menu .menu-inside-wrapper .nav-menu li button:hover,
							.site-header-menu .menu-inside-wrapper .nav-menu li button:focus,
							button#wp-custom-header-video-button:hover,
							button#wp-custom-header-video-button:focus,
							.archive-content-wrap .section-content-wrapper.layout-one .entry-container>.entry-meta .posted-on a:hover,
							.archive-content-wrap .section-content-wrapper.layout-one .entry-container>.entry-meta .posted-on a:focus {
							    color: %1$s;
							}

							@media screen and (min-width: 768px) {
								a.cart-contents:hover,
								a.cart-contents:focus,
								button.menu-toggle:hover,
								button.menu-toggle:focus {
									color: %1$s;
								}
							}',
		),
		'secondary_link_color'           => array(
			'label'   => 	esc_html__( 'Secondary Link Color', 'wen-travel-pro' ),
			'css'     => 	'.site-title a,
							.top-main-wrapper .header-top-right ul li a,
							.top-main-wrapper .header-top-left ul li,
							.top-main-wrapper .header-top-left ul li a,
							a.cart-contents,
							.portfolio-content-wrapper .filter-button-group button,
							.entry-title a,
							button.menu-toggle,
							.menu-toggle,
							.site-header-cart .cart-contents,
							.drop-cap:first-letter,
							.main-navigation .nav-menu>li a,
							#contact-section.has-background-image .entry-container .entry-title,
							.author-name a,
							.comments-title,
							.comment-reply-title,
							.post-navigation .nav-title,
							.left-content .price-offer .offer-lists a,
							.portfolio-content-section.itineraries  .portfolio-content-wrapper .hentry .entry-container .entry-container-inner-wrap .entry-title a,
							.portfolio-content-section.destination  .portfolio-content-wrapper .hentry .entry-container .entry-container-inner-wrap .entry-title a,
							.header-media.content-frame .custom-header-content h2,
							.header-media.content-frame .custom-header-content .header-media-tagline,
							.header-media.content-frame .custom-header-content .site-header-text,
							.dropdown-toggle,
							.menu-social-container a,
							.service-section .more-link,
							.testimonial-content-section .more-link,
							.ghost-button .more-link,
							.stats-section p:not(.view-more) .more-link,
							.featured-content-section .more-link,
							.archive-posts-wrapper .more-link,
							.custom-header .entry-breadcrumbs a,
							.product-container a.button,
							.author-name,
							.comment-reply-link,
							.author-title,
							ins,
							.wp-block-pullquote cite,
							.wp-block-quote cite,
							cite,
							.latest-trip-section label,
							del,
							.entry-meta a,
							.sidebar .widget-wrap li a,
							.widget_recent_entries li a,
							.testimonial-content-section .entry-meta span,
							.onsale,
							.entry-breadcrumbs a,
							.woocommerce.woocommerce-active .woocommerce-breadcrumb a,
							p.stars a,
							.single footer .entry-meta a,
							p.stars a:before,
							.controller:before,
							.tag-cloud-link,
							.select2-results__option,
							body.no-header-media-image .site-header .site-header-main .site-header-menu .menu-inside-wrapper .main-navigation .nav-menu .current_page_item>a,
							#footer-newsletter .wrapper .section-description,
							.widget-wrap span.post-date,
							.contact-section .entry-container a,
							.archive .section-content-wrapper .more-link .readmore,
							.faq-section .hentry .more-link,
							.team-section .hentry .more-link,
							.testimonials-content-wrapper.section.testimonial-wrapper .cycle-prev:before,
							.testimonials-content-wrapper.section.testimonial-wrapper .cycle-prev:after,
							.testimonials-content-wrapper.section.testimonial-wrapper .cycle-next:before,
							.clients-content-wrapper .controller .cycle-pager span,
							.testimonials-content-wrapper .cycle-pager:after,
							.slider-content-wrapper .entry-container .entry-container-wrap .entry-summary,
							.testimonials-content-wrapper .entry-title a,
							.testimonials-content-wrapper.section.testimonial-wrapper .hentry,
							.scrollup a:hover:before,
							.scrollup a:focus:before,
							.sidebar .widget-wrap .more-link,
							.promotion-headline-wrapper.section .section-content-wrap .inner-container .more-button .more-link:hover,
							.promotion-headline-wrapper.section .section-content-wrap .inner-container .more-button .more-link:focus,
							.archive-content-wrap .section-content-wrapper.layout-one .entry-container>.entry-meta .posted-on a,
							.team-section .entry-meta,
							.author-label,
							.author-section-title,
							.comment-permalink,
							.comment-edit-link,
							.entry-title span,
							.nav-subtitle,
							.nav-menu .menu-item-has-children>a:before,
							.nav-menu .menu_item_has_children>a:before,
							.product-content-section span.woocommerce-Price-amount,
							.breadcrumb-area .entry-breadcrumbs,
							.breadcrumb-area .woocommerce-breadcrumb,
							.vcard,
							.position,
							.entry-meta a,
							.collection-content-wrapper .filter-button-group button.button,
							.attraction-content-wrapper .filter-button-group button.button,
							.transparent-header .site-title a,
							.navigation-classic .menu-inside-wrapper .main-navigation ul>li>a,
							.wp-travel-itinerary-items .wp-travel-post-item-wrapper .post-title a,
							.wp-travel-archive-content .wp-travel-default-article .wp-travel-entry-content-wrapper .description-right .wp-travel-explore a {
								color: %1$s;
							}',
		),
		'secondary_link_hover_color'           => array(
			'label'   => 	esc_html__( 'Secondary Link Hover Color', 'wen-travel-pro' ),
			'css'     => 	'.post-title:hover,
							.post-title:focus,
							.has-background-image .offer-lists a:hover,
							.has-background-image .offer-lists a:focus,
							.main-navigation .nav-menu > li a:hover,
							.main-navigation .nav-menu > li a:focus,
							#stats-section .entry-title a:hover,
							#stats-section .entry-title a:focus,
							.navigation.pagination .page-numbers.prev:hover,
							.navigation.pagination .page-numbers.prev:focus,
							.navigation.pagination .page-numbers.next:hover,
							.navigation.pagination .page-numbers.next:focus,
							.left-content .price-offer .offer-lists a:hover,
							.left-content .price-offer .offer-lists a:focus,
							.top-main-wrapper ul li a:hover,
							.top-main-wrapper ul li a:focus,
							.testimonial-content-section .more-link:hover,
							.testimonial-content-section .more-link:focus,
							.transparent-header.has-header-media .site-title a:hover,
							.transparent-header.has-header-media .site-title a:focus,
							#header-content #primary-search-wrapper button.search-submit:hover,
							#header-content #primary-search-wrapper button.search-submit:focus,
							.sidebar .widget-wrap li a:hover,
							.sidebar .widget-wrap li a:focus,
							.has-background-image .woocommerce-loop-product__title:hover,
							.has-background-image .woocommerce-loop-product__title:focus,
							.has-background-image .entry-container .entry-meta a:hover,
							.has-background-image .entry-container .entry-meta a:focus,
							.has-background-image .entry-container .entry-title a:hover,
							.has-background-image .entry-container .entry-title a:focus,
							.single footer .entry-meta a:hover,
							.single footer .entry-meta a:focus,
							#site-footer-navigation li a:hover,
							#site-footer-navigation li a:focus,
							#social-footer-navigation li a:hover,
							#social-footer-navigation li a:focus,
							.has-background-image .entry-title a:hover,
							.has-background-image .entry-title a:focus,
							.has-background-image .entry-meta a:hover,
							.has-background-image .entry-meta a:focus,
							.woocommerce .woocommerce-breadcrumb a:hover,
							.woocommerce .woocommerce-breadcrumb a:focus,
							.team-content-wrapper .entry-container .entry-title a:hover,
							.team-content-wrapper .entry-container .entry-title a:focus,
							.team-content-wrapper .entry-container .entry-meta a:hover,
							.team-content-wrapper .entry-container .entry-meta a:focus,
							.team-content-wrapper .entry-container .social-navigation a:hover,
							.team-content-wrapper .entry-container .social-navigation a:focus,
							#service-section .entry-title a:hover,
							#service-section .entry-title a:focus,
							.events-content-wrapper .entry-meta a:hover,
							.events-content-wrapper .entry-meta a:focus,
							.widget_recent_entries li a:hover,
							.widget_recent_entries li a:focus,
							.portfolio-content-section:not(.itineraries) .hentry .entry-container a:not(.more-link):hover,
							.portfolio-content-section:not(.itineraries) .hentry .entry-container a:not(.more-link):focus,
							.portfolio-content-section:not(.destination) .hentry .entry-container a:not(.more-link):hover,
							.portfolio-content-section:not(.destination) .hentry .entry-container a:not(.more-link):focus,
							.widget .ui-state-default a:hover,
							.widget .ui-state-default a:focus,
							.widget .ui-widget-content .ui-state-default a:hover,
							.widget .ui-widget-content .ui-state-default a:focus,
							.widget .ui-widget-header .ui-state-default a:hover,
							.widget .ui-widget-header .ui-state-default a:focus,
							.tag-cloud-link:hover,
							.tag-cloud-link:focus,
							.nav-title:hover,
							.nav-title:focus,
							.portfolio-content-section.destination .portfolio-content-wrapper .hentry .entry-container .entry-container-inner-wrap .entry-title a:hover,
							.portfolio-content-section.destination .portfolio-content-wrapper .hentry .entry-container .entry-container-inner-wrap .entry-title a:focus,
							.portfolio-content-section.itineraries .portfolio-content-wrapper .hentry .entry-container .entry-container-inner-wrap .entry-title a:hover,
							.portfolio-content-section.itineraries .portfolio-content-wrapper .hentry .entry-container .entry-container-inner-wrap .entry-title a:focus,
							.author a:hover,
							.author a:focus,
							.entry-title a:hover,
							.entry-title a:focus,
							.site-footer td#prev a:hover,
							.site-footer td#prev a:focus,
							.site-footer td#next a:hover,
							.site-footer td#next a:focus,
							.comment-reply-link:hover,
							.comment-reply-link:focus,
							aside.footer-widget-area a:hover,
							aside.footer-widget-area a:focus,
							.portfolio-content-wrapper .filter-button-group button:hover,
							.portfolio-content-wrapper .filter-button-group button:focus,
							.author-section-title:hover,
							.author-section-title:focus,
							.comment-permalink:hover,
							.comment-permalink:focus,
							.comment-edit-link:hover,
							.comment-edit-link:focus,
							.nav-subtitle:hover,
							.nav-subtitle:focus,
							.entry-meta a:hover,
							.entry-meta a:focus,
							.latest-package-wrapper .entry-header .entry-meta a:hover,
							.latest-package-wrapper .entry-header .entry-meta a:focus,
							.testimonials-content-wrapper.section.testimonial-wrapper .entry-title a:hover,
							.testimonials-content-wrapper.section.testimonial-wrapper .entry-title a:focus,
							#site-generator .menu-social-container a:hover,
							#site-generator .menu-social-container a:focus,
							.widget-wrap li a:hover,
							.widget-wrap li a:focus,
							.sidebar .widget-wrap .more-link:hover,
							.sidebar .widget-wrap .more-link:focus,
							.service-section .hentry .more-link:hover,
							.service-section .hentry .more-link:focus,
							#service-section.has-background-image .hentry .more-link:hover,
							#service-section.has-background-image .hentry .more-link:focus,
							#stats-section .hentry .more-link:hover,
							#stats-section .hentry .more-link:focus,
							#service-section .hentry .more-link:hover,
							#service-section .hentry .more-link:focus,
							.breadcrumb a:hover,
							.breadcrumb a:focus,
							aside.footer-widget-area .social-navigation a:hover,
							aside.footer-widget-area .social-navigation a:focus,
							.menu-toggle:hover,
							.menu-toggle:focus,
							.post-navigation a span:hover,
							.post-navigation a span:focus,
							.feature-slider-wrapper .entry-container .entry-title a:hover,
							.feature-slider-wrapper .entry-container .entry-title a:focus,
							.feature-slider-wrapper .entry-container .entry-title span:hover,
							.feature-slider-wrapper .entry-container .entry-title span:focus,
							.archive-posts-wrapper .more-link:hover,
							.archive-posts-wrapper .more-link:focus,
							.portfolio-content-section.itineraries .hentry-inner .trip-footer .entry-meta .icon:hover,
							.portfolio-content-section.itineraries .hentry-inner .trip-footer .entry-meta .icon:focus,
							.portfolio-content-section.destination .hentry-inner .trip-footer .entry-meta .icon:hover,
							.portfolio-content-section.destination .hentry-inner .trip-footer .entry-meta .icon:focus,
							.has-header-image .custom-header .breadcrumb-area .entry-breadcrumbs a:hover,
							.has-header-image .custom-header .breadcrumb-area .entry-breadcrumbs a:focus,
							.custom-header .entry-breadcrumbs a:hover,
							.custom-header .entry-breadcrumbs a:focus,
							.has-header-image .custom-header-content .site-header-text .entry-meta a:hover,
							.has-header-image .custom-header-content .site-header-text .entry-meta a:focus,
							.stats-section p:not(.view-more) .more-link:hover,
							.stats-section p:not(.view-more) .more-link:focus,
							.service-section .more-link:hover,
							.service-section .more-link:focus,
							.entry-title a:hover,
							.entry-title a:focus,
							button.menu-toggle:hover,
							button.menu-toggle:focus,
							.menu-toggle:hover,
							.menu-toggle:focus,
							.site-header-cart .cart-contents:hover,
							.site-header-cart .cart-contents:focus,
							.main-navigation .nav-menu>li a:hover,
							.main-navigation .nav-menu>li a:focus,
							.author-name a:hover,
							.author-name a:focus,
							.left-content .price-offer .offer-lists a:hover,
							.left-content .price-offer .offer-lists a:focus,
							.dropdown-toggle:hover,
							.dropdown-toggle:focus,
							.menu-social-container a:hover,
							.menu-social-container a:focus,
							.custom-header .entry-breadcrumbs a:hover,
							.custom-header .entry-breadcrumbs a:focus,
							.comment-reply-link:hover,
							.comment-reply-link:focus,
							.sidebar .widget-wrap li a:hover,
							.sidebar .widget-wrap li a:focus,
							.widget_recent_entries li a:hover,
							.widget_recent_entries li a:focus,
							.entry-breadcrumbs a:hover,
							.entry-breadcrumbs a:focus,
							.woocommerce.woocommerce-active .woocommerce-breadcrumb a:hover,
							.woocommerce.woocommerce-active .woocommerce-breadcrumb a:focus,
							p.stars a:hover,
							p.stars a:focus,
							.single footer .entry-meta a:hover,
							.single footer .entry-meta a:focus,
							.tag-cloud-link:hover,
							.tag-cloud-link:focus,
							body.no-header-media-image .site-header .site-header-main .site-header-menu .menu-inside-wrapper .main-navigation .nav-menu .current_page_item>a,
							.contact-section .entry-container a:hover,
							.contact-section .entry-container a:focus,
							.archive .section-content-wrapper .more-link .readmore:hover,
							.archive .section-content-wrapper .more-link .readmore:focus,
							.testimonials-content-wrapper .entry-title a:hover,
							.testimonials-content-wrapper .entry-title a:focus,
							.sidebar .widget-wrap .more-link:hover,
							.sidebar .widget-wrap .more-link:focus,
							.archive-content-wrap .section-content-wrapper.layout-one .entry-container>.entry-meta .posted-on a:hover,
							.archive-content-wrap .section-content-wrapper.layout-one .entry-container>.entry-meta .posted-on a:focus,
							.entry-title span:hover,
							.entry-title span:focus,
							p.stars:hover a:before,
							p.stars:focus a:before,
							.star-rating span:before,
							p.stars.selected a.active:before,
							p.stars.selected a:not(.active):before,
							p.stars.selected a.active~a:before,
							p.stars a:hover~a:before,
							p.stars a:focus~a:before,
							.site-header-cart .cart-contents:hover .count,
							.site-header-cart .cart-contents:focus .count,
							.menu-inside-wrapper .main-navigation>.nav-menu>.current_page_item>a,
							#reviews .comment-respond .comment-form-rating .stars span a.active:before,
							.page-numbers.current,
							.breadcrumb-current,
							.page-links .current,
							#testimonial-content-section .section-content-wrapper .entry-content:hover:before,
							#testimonial-content-section .section-content-wrapper .entry-content:focus:before,
							#testimonial-content-section .section-content-wrapper .entry-summary:hover:before,
							#testimonial-content-section .section-content-wrapper .entry-summary:focus:before,
							#site-header-cart-wrapper a.cart-contents .count,
							#reviews .comment-respond .comment-form-rating .stars.selected span a:not(.active):before,
							.wp-travel-itinerary-items .wp-travel-post-item-wrapper .post-title a:hover,
							.wp-travel-itinerary-items .wp-travel-post-item-wrapper .post-title a:focus {
								color: %1$s;
							}',
		),
		'tertiary_link_color'           => array(
			'label'   => 	esc_html__( 'Tertiary Link Color', 'wen-travel-pro' ),
			'css'     => 	'.list-inline li .icon,
							.portfolio-content-section.itineraries .portfolio-content-wrapper .hentry-inner .entry-container .entry-container-inner-wrap .icon, 
							.portfolio-content-section.destination .portfolio-content-wrapper .hentry-inner .entry-container .entry-container-inner-wrap .icon,
							.trip-filter-section .description-box .item .icon:not(.icon-search),
							.wp-travel-itinerary-items .wp-travel-post-item-wrapper .wp-travel-post-content .entry-meta i,
							.wp-travel-archive-content .wp-travel-default-article .wp-travel-entry-content-wrapper .description-left .entry-meta i,
							.wp-travel-itinerary-items .wp-travel-post-item-wrapper .wp-travel-post-content .wp-travel-trip-time i,
							.wp-travel-average-review:before,
							.wp-travel-average-review span {
								color: %1$s;
							}',
		),
		'button_background_color'          => array(
			'label'   => 	esc_html__( 'Button Background Color', 'wen-travel-pro' ),
			'css'     => 	'.feature-slider-wrapper a.more-link,
							.more-link,
							.button,
							.demo_store,
							.sidebar .social-links-menu li a,
							.pagination .page-numbers:not(.next):not(.prev):not(.dots),
							post-page-numbers,
							.section .section-content-wrapper.owl-carousel .owl-nav button,
							#feature-slider-section .section-content-wrapper .owl-nav button,
							input[type="submit"].submit,
							input[type="submit"].wpcf7-submit,
							.section .owl-carousel button.owl-dot,
							.entry-content button,
							.entry-summary button,
							button,
							#scrollup,
							.featured-trip-section .featured-trip-content-wrapper .featured-trip-slider.owl-carousel .owl-nav button,
							.featured-trip-section .featured-trip-content-wrapper .featured-trip-slider-grid.owl-carousel .owl-nav button,
							.slider-content-wrapper .controllers .cycle-prev,
							.slider-content-wrapper .controllers .cycle-next,
							input[type="submit"],
							button[type="submit"],
							.scrollup a,
							.sticky-post,
							#team-dots li.active:after,
							#team-content-section .team-content-wrapper.owl-carousel .owl-nav button:hover,
							#team-content-section .team-content-wrapper.owl-carousel .owl-nav button:focus,
							.wp-block-button__link,
							#infinite-handle .ctis-load-more button,
							.menu-inside-wrapper #site-header-cart-wrappe li>a,
							.contact-section .entry-container ul.contact-details li .fa,
							nav.navigation.posts-navigation .nav-links a,
							.woocommerce-pagination ul.page-numbers li .page-numbers.current,
							.archive-content-wrap .pagination .page-numbers.current,
							.cart-collaterals .shop_table.shop_table_responsive .cart-subtotal,
							.sticky-label,
							.logo-slider-section .owl-dots .owl-dot span,
							.onsale,
							.wp-block-file .wp-block-file__button,
							.wp-block-search .wp-block-search__button,
							.wp-block-button .wp-block-button__link,
							.wp-travel-navigation.wp-paging-navigation ul li .wp-page-numbers,
							.wp-travel-navigation.wp-paging-navigation ul li span.wp-page-numbers,
							.wp-travel-offer span {
							    background-color: %1$s;
							}

							.entry-title .sub-title,
							.section-subtitle,
							#testimonial-content-section .section-content-wrapper .entry-summary:before,
							#testimonial-content-section .section-content-wrapper .entry-content:before,
							.section-title-wrapper+.section-subtitle,
							.section-heading-wrapper>.section-subtitle,
							.skill-section.has-background-image .section-heading-wrapper>.section-subtitle,
							.section-heading-wrapper .sub-title,
							blockquote:not(.alignright):not(.alignleft):before,
							.section-heading-wrapper .entry-title span,
							.countdown-content-wrapper .content-left .price span.offer-price {
								color: %1$s;
							}

							blockquote,
							.wp-block-quote.is-large,
							.wp-block-quote.is-style-large,
							.wp-block-quote,
							.owl-carousel .owl-dots button.owl-dot.active span,
							.logo-slider-section .owl-prev:hover,
							.logo-slider-section .owl-prev:focus,
							.logo-slider-section .owl-next:hover,
							.logo-slider-section .owl-next:focus,
							.woocommerce .products .product-container .button,
							.logo-slider-section .owl-dots .owl-dot.active span,
							blockquote.alignright,
							blockquote.alignleft,
							#contact-section .entry-container .inner-container,
							textarea:focus,
							input[type="text"]:focus,
							input[type="email"]:focus,
							input[type="url"]:focus,
							input[type="password"]:focus,
							input[type="search"]:focus,
							input[type="number"]:focus,
							input[type="tel"]:focus,
							input[type="range"]:focus,
							input[type="date"]:focus,
							input[type="month"]:focus,
							input[type="week"]:focus,
							input[type="time"]:focus,
							input[type="datetime"]:focus,
							input[type="datetime-local"]:focus,
							input[type="color"]:focus,
							.wpcf7 div input:focus,
							.wpcf7 div textarea:focus,
							#contact-section .hentry input:not([type="submit"]):focus, 
							#contact-section .hentry textarea:focus,
							.trip-filter-section .description-box .item select:focus,
							.trip-filter-section .description-box .item input[type="text"]:focus,
							.trip-filter-section .description-box .item.item-1 select:focus,
							.trip-filter-section .description-box .item.item-2 select:focus {
								border-color: %1$s;
							}',
		),
		'button_text_color'        => array(
			'label'   => 	esc_html__( 'Button Text Color', 'wen-travel-pro' ),
			'css'     => 	'.more-link,
							.entry-content button,
							.entry-summary button,
							.section .section-content-wrapper.owl-carousel .owl-nav button,
							#feature-slider-section .section-content-wrapper .owl-nav button,
							input[type="submit"].submit,
							.sidebar .social-links-menu li a,
							input[type="submit"].wpcf7-submit,
							.slider-content-wrapper .controllers .cycle-prev,
							.slider-content-wrapper .controllers .cycle-next,
							button,
							#scrollup,
							.featured-trip-section .featured-trip-content-wrapper .featured-trip-slider.owl-carousel .owl-nav button,
							.featured-trip-section .featured-trip-content-wrapper .featured-trip-slider-grid.owl-carousel .owl-nav button,
							#primary-search-wrapper .search-container button,
							input[type="submit"],
							.button,
							.scrollup a:before,
							.page-numbers:hover,
							.page-numbers:focus,
							post-page-numbers:hover,
							post-page-numbers:focus,
							button[type="submit"],
							button#wp-custom-header-video-button,
							#infinite-handle .ctis-load-more button,
							nav.navigation.posts-navigation .nav-links a,
							.woocommerce-pagination ul.page-numbers li:hover,
							.archive-content-wrap .pagination .page-numbers:hover,
							.archive-content-wrap .pagination .page-numbers:focus,
							.woocommerce-pagination ul.page-numbers li:focus,
							.archive-content-wrap .pagination .page-numbers.current,
							.woocommerce-pagination ul.page-numbers li .page-numbers.current,
							.portfolio-content-section .entry-container,
							.nav-menu .menu-item-has-children>a:hover:before,
							.nav-menu .menu-item-has-children>a:focus:before,
							.nav-menu .menu_item_has_children>a:hover:before,
							.nav-menu .menu_item_has_children>a:focus:before,
							.contact-section .entry-container ul.contact-details li .fa,
							.onsale,
							.cart-collaterals .shop_table.shop_table_responsive .cart-subtotal,
							.collection-content-wrapper .filter-button-group button.button.is-checked,
							.attraction-content-wrapper .filter-button-group button.button.is-checked,
							.wp-block-file .wp-block-file__button,
							.wp-block-search .wp-block-search__button,
							.wp-block-button .wp-block-button__link,
							.wp-travel-navigation.wp-paging-navigation ul li .wp-page-numbers,
							.wp-travel-navigation.wp-paging-navigation ul li span.wp-page-numbers {
								color: %1$s;
							}',
		),
		'button_background_hover_color'    => array(
			'label'   => 	esc_html__( 'Button Background Hover Color', 'wen-travel-pro' ),
			'css'     => 	'.more-link:hover,
							.more-link:focus,
							.button:hover,
							.button:focus,
							.ghost-button .more-link:hover,
							.ghost-button .more-link:focus,
							.sidebar .social-links-menu li a:hover,
							.sidebar .social-links-menu li a:focus,
							.section .section-content-wrapper.owl-carousel .owl-nav button:hover,
							.section .section-content-wrapper.owl-carousel .owl-nav button:focus,
							#feature-slider-section .section-content-wrapper .owl-nav button:hover,
							#feature-slider-section .section-content-wrapper .owl-nav button:focus,
							#contact-section.has-background-image input[type="submit"]:hover,
							#contact-section.has-background-image input[type="submit"]:focus,
							#scrollup:hover,
							#scrollup:focus,
							button:hover,
							button:focus,
							.featured-trip-section .featured-trip-content-wrapper .featured-trip-slider.owl-carousel .owl-nav button:hover,
							.featured-trip-section .featured-trip-content-wrapper .featured-trip-slider.owl-carousel .owl-nav button:focus,
							.featured-trip-section .featured-trip-content-wrapper .featured-trip-slider-grid.owl-carousel .owl-nav button:hover,
							.featured-trip-section .featured-trip-content-wrapper .featured-trip-slider-grid.owl-carousel .owl-nav button:focus,
							input[type="submit"]:hover,
							input[type="submit"]:focus,
							.scrollup a:hover,
							.scrollup a:focus,
							.logo-slider-section .owl-prev:hover,
							.logo-slider-section .owl-prev:focus,
							.logo-slider-section .owl-next:hover,
							.logo-slider-section .owl-next:focus,
							button[type="submit"]:hover,
							button[type="submit"]:focus,
							.wp-block-button__link:hover,
							.wp-block-button__link:focus,
							.promotion-section .play-button:hover,
							.promotion-section .play-button:focus,
							.woocommerce .products .product-container .button:hover,
							.woocommerce .products .product-container .button:focus,
							#infinite-handle .ctis-load-more button:hover,
							#infinite-handle .ctis-load-more button:focus,
							.slider-content-wrapper .cycle-next:hover,
							.slider-content-wrapper .cycle-next:focus,
							.slider-content-wrapper .cycle-prev:hover,
							.slider-content-wrapper .cycle-prev:focus,
							nav.navigation.posts-navigation .nav-links a:hover,
							nav.navigation.posts-navigation .nav-links a:focus,
							.woocommerce-pagination ul.page-numbers li .page-numbers:hover,
							.woocommerce-pagination ul.page-numbers li .page-numbers:focus,
							.archive-content-wrap .pagination .page-numbers:hover,
							.archive-content-wrap .pagination .page-numbers:focus,
							.feature-slider-wrapper .entry-summary a:hover,
							.feature-slider-wrapper .entry-summary a:focus,
							#contact-section input[type="submit"]:hover,
							#contact-section input[type="submit"]:focus,
							#feature-slider-section .more-link:hover,
							#feature-slider-section .more-link:focus,
							.wp-travel-navigation.wp-paging-navigation ul li .wp-page-numbers:hover,
							.wp-travel-navigation.wp-paging-navigation ul li .wp-page-numbers:focus,
							.wp-travel-navigation.wp-paging-navigation ul li span.wp-page-numbers:hover,
							.wp-travel-navigation.wp-paging-navigation ul li span.wp-page-numbers:focus,
							.wp-travel-archive-content .wp-travel-default-article .wp-travel-entry-content-wrapper .description-right .wp-travel-explore a:hover,
							.wp-travel-archive-content .wp-travel-default-article .wp-travel-entry-content-wrapper .description-right .wp-travel-explore a:focus {
							    background-color: %1$s;
							}

							.featured-video-section .custom-video-button:hover::after,
							.featured-video-section .custom-video-button:focus::after {
							    background-color: %1$s;
							}
							.navigation.pagination .nav-links .page-numbers.current,
							post-page-numbers.current,
							.wp-travel-navigation.wp-paging-navigation ul li .wp-page-numbers.current {
								background-color: %1$s;
							}
							
							.color-scheme-photography .header-style-one #primary-search-wrapper .menu-inside-wrapper,
							.color-scheme-photography .portfolio-content-wrapper .filter-button-group button.is-checked,
							.color-scheme-photography .collection-content-wrapper .filter-button-group button.button.is-checked,
							.color-scheme-photography .attraction-content-wrapper .filter-button-group button.button.is-checked {
								background-color: %1$s;
							}',
		),
		'button_text_hover_color'  => array(
			'label'   => 	esc_html__( 'Button Hover Text Color', 'wen-travel-pro' ),
			'css'     => 	'.more-link:hover,
							.more-link:focus,
							button:hover,
							button:focus,
							.button:hover,
							.button:focus,
							post-page-numbers:hover,
							post-page-numbers:focus,
							.sidebar .social-links-menu li a:hover,
							.sidebar .social-links-menu li a:focus,
							.pagination .page-numbers:not(.next):not(.prev):not(.dots):hover,
							.pagination .page-numbers:not(.next):not(.prev):not(.dots):focus,
							.section .section-content-wrapper.owl-carousel .owl-nav button:hover,
							.section .section-content-wrapper.owl-carousel .owl-nav button:focus,
							#feature-slider-section .section-content-wrapper .owl-nav button:hover,
							#feature-slider-section .section-content-wrapper .owl-nav button:focus,
							.portfolio-content-section:not(.itineraries) .more-link:hover,
							.portfolio-content-section:not(.itineraries) .more-link:focus,
							.portfolio-content-section:not(.destination) .more-link:hover,
							.portfolio-content-section:not(.destination) .more-link:focus,
							.featured-trip-section .featured-trip-content-wrapper .featured-trip-slider.owl-carousel .owl-nav button:hover,
							.featured-trip-section .featured-trip-content-wrapper .featured-trip-slider.owl-carousel .owl-nav button:focus,
							.featured-trip-section .featured-trip-content-wrapper .featured-trip-slider-grid.owl-carousel .owl-nav button:hover,
							.featured-trip-section .featured-trip-content-wrapper .featured-trip-slider-grid.owl-carousel .owl-nav button:focus,
							.ghost-button .more-link:hover,
							.ghost-button .more-link:focus,
							.entry-content button:hover,
							.entry-content button:focus,
							.entry-summary button:hover,
							.entry-summary button:focus,
							input[type="submit"]:hover,
							input[type="submit"]:focus,
							button[type="submit"]:hover,
							button[type="submit"]:focus,
							#primary-search-wrapper .search-container button:hover,
							#primary-search-wrapper .search-container button:focus,
							#infinite-handle .ctis-load-more button:hover,
							#infinite-handle .ctis-load-more button:focus,
							nav.navigation.posts-navigation .nav-links a:hover,
							nav.navigation.posts-navigation .nav-links a:focus,
							.feature-slider-wrapper .entry-summary a:hover,
							.feature-slider-wrapper .entry-summary a:focus,
							#contact-section input[type="submit"]:hover,
							#contact-section input[type="submit"]:focus,
							.logo-slider-section .owl-prev:hover,
							.logo-slider-section .owl-prev:focus,
							.logo-slider-section .owl-next:hover,
							.logo-slider-section .owl-next:focus,
							.product-container a.button:hover,
							.product-container a.button:focus,
							#scrollup:hover,
							#scrollup:focus,
							.wp-travel-archive-content .wp-travel-default-article .wp-travel-entry-content-wrapper .description-right .wp-travel-explore a:hover,
							.wp-travel-archive-content .wp-travel-default-article .wp-travel-entry-content-wrapper .description-right .wp-travel-explore a:focus {
							        color: %1$s;
							}
							.navigation.pagination .nav-links .page-numbers.current,
							.post-page-numbers.current {
								color: %1$s;
							}',
		),
		'border_color'             => array(
			'label'   => 	esc_html__( 'Border Color', 'wen-travel-pro' ),
			'css'     => 	'.page .site-main .entry-footer .entry-meta>a,
							.header-style-two  #site-header-top-menu::after,
							.color-scheme-corporate.header-style-two .header-top-bar:after,
							.single .site-main .entry-footer .entry-meta>a,
							.tagcloud a,
							.widget-area .essential-widgets .tagcloud a, 
							.widget-area .essential-widgets .tagcloud.rounded-corners a,
							.post-navigation .nav-links,
							#site-header-top-menu,
							.wp-block-calendar tbody td, 
							.wp-block-calendar th,
							aside.widget-area + div#site-generator:before,
							.header-style-one .site-header-menu,
							.latest-trip-section .hentry-inner .entry-meta li,
							.trip-content-wrapper .hentry-inner .entry-container .entry-summary,
							.trip-content-wrapper .hentry-inner .entry-container .entry-content,
							.portfolio-content-section.itineraries .portfolio-content-wrapper .hentry-inner .entry-container .entry-container-inner-wrap .trip-footer,
							.portfolio-content-section.destination .portfolio-content-wrapper .hentry-inner .entry-container .entry-container-inner-wrap .trip-footer,
							.post-navigation .nav-previous,
							.ghost-button .more-link,
							.trip-filter-section .description-box .item select,
							.trip-filter-section .description-box .item input[type="text"],
							.featured-trip-section .inner-container,
							.woocommerce-ordering select,
							.list-inline li,
							.latest-trip-section .meta-wrapper,
							.woocommerce-tabs .panel,
							.woocommerce-tabs ul.tabs li.active a:after,
							.woocommerce-tabs ul.tabs:after,
							.calendar_wrap tbody tr:first-child,
							.calendar_wrap tbody tr:last-child,
							tfoot,
							tfoot tr td,
							.author-info,
							.wpcf7 div input,
							.wpcf7 div textarea,
							.navigation-classic .main-navigation ul ul,
							.woocommerce-shorting-wrapper,
							.woocommerce-tabs ul.tabs.wc-tabs li,
							.menu-wrapper .widget_shopping_cart ul.woocommerce-mini-cart li,
							.entry-summary form.cart,
							.widget_recent_entries li,
							.team-section .team-content-wrapper .hentry .team-social-profile .social-links-menu,
							#contact-section .hentry input:not([type="submit"]), 
							#contact-section .hentry textarea,
							input[type="submit"],
							input[type="text"],
							input[type="email"],
							input[type="url"],
							input[type="password"],
							input[type="search"],
							input[type="number"],
							input[type="tel"],
							input[type="range"],
							input[type="date"],
							input[type="month"],
							input[type="week"],
							input[type="time"],
							input[type="datetime"],
							input[type="datetime-local"],
							input[type="color"],
							textarea,
							table,
							caption,
							table th,
							table thead tr,
							table thead th,
							thead th,
							tbody th,
							tbody td,
							tbody tr,
							table.shop_table_responsive tr td,
							table tbody tr,
							table.shop_table_responsive tbody tr:last-child,
							.shop_table tfoot tr td,
							.shop_table tfoot tr th,
							table.shop_table.woocommerce-checkout-review-order-table .cart_item td,
							table.shop_table.woocommerce-checkout-review-order-table tr td,
							table.shop_table.woocommerce-checkout-review-order-table tr th,
							.rtl tbody td:last-child,
							.rtl table thead th:last-child,
							.select2-container--default .select2-selection--single,
							table.woocommerce-grouped-product-list.group_table,
							table.woocommerce-grouped-product-list.group_table td,
							table.variations,
							table.variations td,
							.woocommerce-pagination ul.page-numbers li .page-numbers,
							.archive-content-wrap .navigation.pagination .page-numbers,
							.woocommerce-posts-wrapper .summary.entry-summary .woocommerce-product-rating,
							.cart-collaterals .order-total,
							#payment .wc_payment_methods .payment_box,
							.products .product,
							select,
							header .site-header-main,
							abbr,
							acronym,
							.product-quantity input[type="number"],
							.coupon input[type="text"],
							.site-header-main .menu-inside-wrapper,
							.site-header-cart .widget_shopping_cart,
							.woocommerce-grouped-product-list tr,
							.mobile-social-search,
							.widget .ui-tabs .ui-tabs-panel,
							.site-header-menu .menu-inside-wrapper .nav-menu button:focus,
							header .site-header-menu .menu-inside-wrapper .main-navigation .sub-menu li:last-child,
							header .site-header-menu .menu-inside-wrapper .main-navigation .children li:last-child,
							.header-style-one .site-header-main>.wrapper:after,
							.header-style-two #site-header-top-menu::after,
							#site-header-top-menu:after,
							.comment-body,
							.promotion-headline-wrapper.section .section-content-wrap .inner-container .more-button .more-link,
							.archive-content-wrap .section-content-wrapper.layout-one .hentry .hentry-inner .entry-container>.entry-meta,
							.section:nth-child(even)+.site-content,
							.comments-area,
							.events-content-wrapper .hentry,
							.featured-content-wrapper .hentry-inner,
							.wp-block-table,
							.wp-block-table caption,
							.wp-block-table th,
							.wp-block-table td,
							.wp-block-table figcaption,
							.wp-block-table tfoot,
							.latest-package-wrapper .hentry-inner .entry-container,
							.latest-package-wrapper .hentry-inner .button-wrap,
							.wp-travel-archive-content .wp-travel-default-article .wp-travel-entry-content-wrapper .description-right .wp-travel-explore a,
							.site-content+.section:nth-child(even),
							.wp-travel-toolbar,
							.wp-travel-default-article,
							.wp-travel-default-article .wp-travel-entry-content-wrapper .description-right,
							.wp-travel-itinerary-items .wp-travel-itinerary-list li,
							.trip-headline-wrapper .featured-detail-section .right-plot-inner-wrap .wp-travel-trip-meta-info {
							    border-color: %1$s;
							}',
		),
		'content_color_white'        => array(
			'label'   => 	esc_html__( 'Content Color White', 'wen-travel-pro' ),
			'priority' => 1,
			'css'     => 	'.featured-trip-section .entry-title a,
							.collection-content-section .entry-title a,
							.attraction-content-section .entry-title a,
							.featured-content-section .section-content-wrapper .post-thumbnail .entry-title a,
							.collection-content-wrapper .entry-meta a,
							.collection-content-wrapper .entry-container-inner-wrap .sub-title,
							.attraction-content-wrapper .entry-meta a,
							.attraction-content-wrapper .entry-container-inner-wrap .sub-title,
							.featured-content-section .section-content-wrapper .post-thumbnail .entry-meta a,
							.latest-trip-section .entry-title a,
							.latest-trip-section .entry-header,
							.demo_store,
							.sticky-post,
							.scroll-down,
							.site-info a,
							.site-info,
							ins,
							#header-content #primary-search-wrapper input[type="search"],
							.has-background-image .portfolio-content-wrapper .filter-button-group button,
							aside.footer-widget-area .widget,
							aside.footer-widget-area .author-label,
							aside.footer-widget-area svg,
							aside.footer-widget-area a,
							#testimonial-content-section .owl-next:hover,
							#testimonial-content-section .owl-next:focus,
							#testimonial-content-section .owl-prev:hover,
							#testimonial-content-section .owl-prev:focus,
							.woocommerce .custom-header .woocommerce-breadcrumb a,
							.has-header-image .custom-header .breadcrumb-area .entry-breadcrumbs,
							.has-header-image .custom-header .breadcrumb-area .entry-breadcrumbs a,
							.has-header-image .custom-header .breadcrumb-area .woocommerce-breadcrumb,
							.custom-header-content .entry-title .sub-title,
							.hero-content-wrapper.has-background-image .entry-container,
							.portfolio-content-section:not(.itineraries) .hentry .entry-container a:not(.more-link),
							.portfolio-content-section:not(.destination) .hentry .entry-container a:not(.more-link),
							.portfolio-content-wrapper .hentry .entry-container .entry-meta time,
							.portfolio-content-wrapper .hentry .entry-container .entry-summary,
							.custom-header-content .entry-container,
							.custom-header-content .entry-container .entry-title,
							.ewnewsletter.has-background-image .section-title,
							.site-footer .widget-wrap .widget-title,
							.site-footer .widget-wrap .wp-block-group h2,
							.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .hentry,
							.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .position,
							.slider-content-wrapper.content-frame .entry-container .entry-title a,
							.slider-content-wrapper.content-frame .entry-container .entry-container-wrap .entry-summary,
							aside.footer-widget-area .widget-title,
							aside.footer-widget-area .wp-block-group h2,
							aside.footer-widget-area .widget_block h1,
							aside.footer-widget-area .widget_block h2,
							aside.footer-widget-area .widget_block h3,
							aside.footer-widget-area .widget_block h4,
							aside.footer-widget-area .widget_block h5,
							aside.footer-widget-area .widget_block h6,
							.has-background-image .section-title,
							.has-background-image .offer-lists,
							.has-background-image .left-content .left-content-offer .entry-title,
							.has-background-image .price-content,
							.has-background-image .price-offer .offer-lists a,
							.has-background-image .entry-container .entry-meta a,
							.has-background-image .entry-container .entry-title a,
							.has-background-image .entry-container .entry-title,
							.has-background-image .entry-container .entry-title span,
							.has-background-image .entry-container .entry-summary,
							.has-background-image .entry-container .entry-content,
							.has-background-image .woocommerce-loop-product__title,
							.content-color-white .entry-container .entry-title a,
							.content-color-white .entry-container .entry-title,
							.content-color-white .entry-container .section-description,
							.content-color-white .entry-container .entry-content,
							.content-color-white .entry-container .entry-summary,
							.promotion-section .play-button,
							.has-background-image .products .button,
							#feature-slider-section .owl-nav button:hover:before,
							#feature-slider-section .owl-nav button:focus:before,
							.playlist-content-wrapper .wp-playlist-caption,
							#service-section.has-background-image .hentry .more-link,
							#stats-section.has-background-image .hentry .more-link,
							.skillbar-item .skillbar-bar .skillbar-header,
							.portfolio-content-wrapper .filter-button-group button.is-checked,
							.skillbar-item .skillbar-bar .skillbar-header .entry-title,
							.play-button-text,
							aside.footer-widget-area .social-navigation a,
							#contact-section.has-background-image .entry-content,
							#contact-section.has-background-image .entry-summary,
							.playlist-content-wrapper .wp-playlist-tracks,
							#social-footer-navigation li a,
							#site-footer-navigation li a,
							.footer-contact,
							#header-content #primary-search-wrapper button.search-submit,
							#contact-section .entry-container .entry-content .contact-details label,
							#contact-section .entry-container .entry-summary .contact-details label,
							.has-background-image .section-description-wrapper,
							.has-background-image .section-title-wrapper+.section-description,
							.has-background-image .section-title+.section-description,
							.has-background-image .section-title-wrapper+.section-subtitle,
							.has-background-image .section-heading-wrapper>.section-description,
							.has-background-image .section-title+.section-description,
							.has-background-image .section-heading-wrapper>.section-subtitle,
							.transparent-header.has-header-image .site-title a,
							.transparent-header.has-header-image .site-description,
							.transparent-header.has-header-media.has-header-image .menu-toggle,
							.transparent-header.has-header-media.has-header-image .menu-toggle:hover, 
							.transparent-header.has-header-media.has-header-image .menu-toggle:focus,
							.transparent-header.has-header-media.has-header-image .top-main-wrapper .header-top-right ul li a:hover,
							.transparent-header.has-header-media.has-header-image .top-main-wrapper .header-top-right ul li a:focus,
							.transparent-header.has-header-media.has-header-image .top-main-wrapper .header-top-left ul li a:hover,
							.transparent-header.has-header-media.has-header-image .top-main-wrapper .header-top-left ul li a:focus,
							.transparent-header.has-header-media.has-header-image .top-main-wrapper .header-top-right ul li a,
							.transparent-header.has-header-media.has-header-image .top-main-wrapper .header-top-left ul li a,
							.transparent-header.has-header-media.has-header-image .top-main-wrapper .header-top-left ul li,
							.transparent-header.has-header-image:not(.header-style-two).has-header-media header .social-navigation li a,
    						.transparent-header.has-header-image:not(.header-style-two).slider-after-header header .social-navigation li a,
							.transparent-header.has-header-image:not(.header-style-two).has-header-media header .social-navigation li a:hover,
							.transparent-header.has-header-image:not(.header-style-two).has-header-media header .social-navigation li a:focus,
							.transparent-header.has-header-image:not(.header-style-two).slider-after-header header .social-navigation li a:hover,
							.transparent-header.has-header-image:not(.header-style-two).slider-after-header header .social-navigation li a:focus,
							.countdown-content-wrapper .content-right #clock {
							    color: %1$s;
							}

							.promotion-section .play-button,
							.transparent-header.has-header-image.header-style-two .header-top-bar:after,
							.transparent-header.has-header-image.header-style-one #site-header-top-menu::after,
							.transparent-header.has-header-image.header-style-two #site-header-top-menu::after,
							.transparent-header.header-style-one .site-header-main>.wrapper:after,
							.header-style-one .site-header-menu:before,
							.color-scheme-dark.header-style-one #primary-search-wrapper .menu-inside-wrapper input[type="search"]:focus {
								border-color: %1$s;
							}

							@media screen and (min-width: 568px) {
								.hero-content-wrapper .video-wrapper .section-title,
								.hero-content-wrapper .video-wrapper .section-description {
									color: %1$s;
								}
							}
							#header-content #primary-search-wrapper input[type="search"]::-moz-placeholder {
								color: %1$s;
							}
							
							#header-content #primary-search-wrapper input[type="search"]:-moz-placeholder {
								color: %1$s;
							}
							#header-content #primary-search-wrapper input[type="search"]::-webkit-input-placeholder {
								color: %1$s;
							}
							
							#header-content #primary-search-wrapper input[type="search"]:-ms-input-placeholder {
								color: %1$s;
							}
							
							.transparent-header.navigation-classic.has-header-media .main-navigation .nav-menu>li>a:before,
							.transparent-header.navigation-classic.slider-afer-header .main-navigation .nav-menu>li>a:before,
							.widget_categories ul li span:after, 
							.widget_archive ul li span:after,
							.countdown-content-wrapper .content-right #clock .count-down > span:after,
							.main-navigation .nav-menu>li>a:before {
								background-color: %1$s;
							}',
		),
		'gradient_button_background_color_first'        => array(
			'label'       => 	esc_html__( 'Gradient Button Background Color First', 'wen-travel-pro' ),
			'is_gradient' => 	true,
			'css'         => 	'
								/* Gradient Button Background Color */

								.gradient-button-enabled .feature-slider-wrapper a.more-link,
								.gradient-button-enabled .more-link,
								.gradient-button-enabled .button,
								.gradient-button-enabled .sidebar .social-links-menu li a,
								.gradient-button-enabled .pagination .page-numbers:not(.next):not(.prev):not(.dots),
								.gradient-button-enabled .post-page-numbers,
								.gradient-button-enabled .demo_store,
								.gradient-button-enabled .section .section-content-wrapper.owl-carousel .owl-nav button,
								.gradient-button-enabled #feature-slider-section .section-content-wrapper .owl-nav button,
								.gradient-button-enabled input[type="submit"].submit,
								.gradient-button-enabled input[type="submit"].wpcf7-submit,
								.gradient-button-enabled .section .owl-carousel button.owl-dot,
								.gradient-button-enabled .entry-content button,
								.gradient-button-enabled .entry-summary button,
								.gradient-button-enabled button,
								.gradient-button-enabled #scrollup,
								.gradient-button-enabled .featured-trip-section .featured-trip-content-wrapper .featured-trip-slider.owl-carousel .owl-nav button,
								.gradient-button-enabled .featured-trip-section .featured-trip-content-wrapper .featured-trip-slider-grid.owl-carousel .owl-nav button,
								.gradient-button-enabled .slider-content-wrapper .controllers .cycle-prev,
								.gradient-button-enabled .slider-content-wrapper .controllers .cycle-next,
								.gradient-button-enabled input[type="submit"],
								.gradient-button-enabled button[type="submit"],
								.gradient-button-enabled .scrollup a,
								.gradient-button-enabled .sticky-post,
								.gradient-button-enabled #team-dots li.active:after,
								.gradient-button-enabled #team-content-section .team-content-wrapper.owl-carousel .owl-nav button:hover,
								.gradient-button-enabled #team-content-section .team-content-wrapper.owl-carousel .owl-nav button:focus,
								.gradient-button-enabled .wp-block-button__link,
								.gradient-button-enabled #infinite-handle .ctis-load-more button,
								.gradient-button-enabled .menu-inside-wrapper #site-header-cart-wrappe li > a,
								.gradient-button-enabled .contact-section .entry-container ul.contact-details li .fa,
								.gradient-button-enabled nav.navigation.posts-navigation .nav-links a,
								.gradient-button-enabled .woocommerce-pagination ul.page-numbers li .page-numbers.current,
								.gradient-button-enabled .archive-content-wrap .pagination .page-numbers.current,
								.gradient-button-enabled .cart-collaterals .shop_table.shop_table_responsive .cart-subtotal,
								.gradient-button-enabled .sticky-label,
								.gradient-button-enabled .logo-slider-section .owl-dots .owl-dot span,
								.gradient-button-enabled .onsale {
									background-image: linear-gradient(to left, %1$s, %2$s);
								}',
		),
		'gradient_button_background_color_first_next'        => array(
			'label'       => esc_html__( 'Gradient Button Background Color Second', 'wen-travel-pro' ),
			'is_gradient' => true,
		),
		'gradient_button_background_hover_color_first'        => array(
			'label'       => 	esc_html__( 'Gradient Button Background Hover Color First', 'wen-travel-pro' ),
			'is_gradient' => 	true,
			'css'         => 	'
								/* Gradient Button Background Hover Color */

								.gradient-button-enabled .more-link:hover,
								.gradient-button-enabled .more-link:focus,
								.gradient-button-enabled .button:hover,
								.gradient-button-enabled .button:focus,
								.gradient-button-enabled .ghost-button .more-link:hover,
								.gradient-button-enabled .ghost-button .more-link:focus,
								.gradient-button-enabled .sidebar .social-links-menu li a:hover,
								.gradient-button-enabled .sidebar .social-links-menu li a:focus,
								.gradient-button-enabled .section .section-content-wrapper.owl-carousel .owl-nav button:hover,
								.gradient-button-enabled .section .section-content-wrapper.owl-carousel .owl-nav button:focus,
								.gradient-button-enabled #feature-slider-section .section-content-wrapper .owl-nav button:hover,
								.gradient-button-enabled #feature-slider-section .section-content-wrapper .owl-nav button:focus,
								.gradient-button-enabled #contact-section.has-background-image input[type="submit"]:hover,
								.gradient-button-enabled #contact-section.has-background-image input[type="submit"]:focus,
								.gradient-button-enabled #scrollup:hover,
								.gradient-button-enabled #scrollup:focus,
								.gradient-button-enabled button:hover,
								.gradient-button-enabled button:focus,
								.gradient-button-enabled .pagination .page-numbers:not(.next):not(.prev):not(.dots):hover,
								.gradient-button-enabled .pagination .page-numbers:not(.next):not(.prev):not(.dots):focus,
								.gradient-button-enabled .post-page-numbers:hover,
								.gradient-button-enabled .post-page-numbers:focus,
								.gradient-button-enabled .featured-trip-section .featured-trip-content-wrapper .featured-trip-slider.owl-carousel .owl-nav button:hover,
								.gradient-button-enabled .featured-trip-section .featured-trip-content-wrapper .featured-trip-slider.owl-carousel .owl-nav button:focus,
								.gradient-button-enabled .featured-trip-section .featured-trip-content-wrapper .featured-trip-slider-grid.owl-carousel .owl-nav button:hover,
								.gradient-button-enabled .featured-trip-section .featured-trip-content-wrapper .featured-trip-slider-grid.owl-carousel .owl-nav button:focus,
								.gradient-button-enabled input[type="submit"]:hover,
								.gradient-button-enabled input[type="submit"]:focus,
								.gradient-button-enabled .scrollup a:hover,
								.gradient-button-enabled .scrollup a:focus,
								.gradient-button-enabled .logo-slider-section .owl-prev:hover,
								.gradient-button-enabled .logo-slider-section .owl-prev:focus,
								.gradient-button-enabled .logo-slider-section .owl-next:hover,
								.gradient-button-enabled .logo-slider-section .owl-next:focus,
								.gradient-button-enabled button[type="submit"]:hover,
								.gradient-button-enabled button[type="submit"]:focus,
								.gradient-button-enabled .wp-block-button__link:hover,
								.gradient-button-enabled .wp-block-button__link:focus,
								.gradient-button-enabled .promotion-section .play-button:hover,
								.gradient-button-enabled .promotion-section .play-button:focus,
								.gradient-button-enabled .woocommerce .products .product-container .button:hover,
								.gradient-button-enabled .woocommerce .products .product-container .button:focus,
								.gradient-button-enabled #infinite-handle .ctis-load-more button:hover,
								.gradient-button-enabled #infinite-handle .ctis-load-more button:focus,
								.gradient-button-enabled .slider-content-wrapper .cycle-next:hover,
								.gradient-button-enabled .slider-content-wrapper .cycle-next:focus,
								.gradient-button-enabled .slider-content-wrapper .cycle-prev:hover,
								.gradient-button-enabled .slider-content-wrapper .cycle-prev:focus,
								.gradient-button-enabled .contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:hover,
								.gradient-button-enabled .contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:focus,
								.gradient-button-enabled nav.navigation.posts-navigation .nav-links a:hover,
								.gradient-button-enabled nav.navigation.posts-navigation .nav-links a:focus,
								.gradient-button-enabled .woocommerce-pagination ul.page-numbers li .page-numbers:hover,
								.gradient-button-enabled .woocommerce-pagination ul.page-numbers li .page-numbers:focus,
								.gradient-button-enabled .archive-content-wrap .pagination .page-numbers:hover,
								.gradient-button-enabled .archive-content-wrap .pagination .page-numbers:focus,
								.gradient-button-enabled .feature-slider-wrapper .entry-summary a:hover,
								.gradient-button-enabled .feature-slider-wrapper .entry-summary a:focus,
								.gradient-button-enabled #contact-section input[type="submit"]:hover,
								.gradient-button-enabled #contact-section input[type="submit"]:focus,
								.gradient-button-enabled #feature-slider-section .more-link:hover,
								.gradient-button-enabled #feature-slider-section .more-link:focus {
									background-image: linear-gradient(to left, %1$s, %2$s);
								}',
		),
		'gradient_button_background_hover_color_first_next'        => array(
			'label'       => esc_html__( 'Gradient Button Background Hover Color Second', 'wen-travel-pro' ),
			'is_gradient' => true,
		),
	);

	return apply_filters( 'wen_travel_color_options', $color_options );
}

/**
 * Customize video play/pause button in the custom header.
 *
 * @param array $settings header video settings.
 */
function wen_travel_video_controls( $settings ) {
	$settings['l10n']['play'] = '<span class="screen-reader-text">' . esc_html__( 'Play background video', 'wen-travel-pro' ) . '</span>' . wen_travel_get_svg( array( 'icon' => 'play' ) );
	$settings['l10n']['pause'] = '<span class="screen-reader-text">' . esc_html__( 'Pause background video', 'wen-travel-pro' ) . '</span>' . wen_travel_get_svg( array( 'icon' => 'pause' ) );
	return $settings;
}
add_filter( 'header_video_settings', 'wen_travel_video_controls' );

/**
 * Registers color schemes for Zubin.
 *
 * Can be filtered with {@see 'wen_travel_color_schemes'}.
 *
 * The order of colors in a colors array:
*1. Body Background Color
*2. Header Text Color
*3. Primary Background Color
*4. Secondary Background Color
*5. Tertiary Background Color
*6. Footer Background Color
*7. Main Text Color
*8. Transparent Header Text Color
*9. Transparent Header Hover Text Color
*10. Transparent Header Navigation Color
*11. Transparent Header Navigation Hover Color
*12. Custom Header Slider Text Color
*13. Heading Text Color
*14. Link Color 
*15. Link Hover Color
*16. Secondary Link Color
*17. Secondary Link Hover Color
*18. Tertiary Link Color
*19. Button Background Color
*20. Button Text Color
*21. Button Background Hover Color
*22. Button Text Hover Color
*23. Border Color
*24. Content Color White

 *
 * @since 1.0
 *
 * @return array An associative array of color scheme options.
 */
function wen_travel_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Zubin.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, main text, secondary text.
	 *     }
	 * }
	 */
	return apply_filters( 'wen_travel_color_schemes', array(
		'default' => array(
			'label'  => esc_html__( 'Default', 'wen-travel-pro' ),
			'colors' => array(
				'background_color'         							=> '#ffffff', /* Body Background Color */
				'header_textcolor' 						    		=> '#ffffff', /* Header Text Color */
				'primary_background_color'         					=> '#ffffff', /* Primary Background Color */
				'secondary_background_color'            			=> '#f6f6f6', /* Secondary Background Color */
				'tertiary_background_color'            				=> '#061d55', /* Tertiary Background Color */
				'footer_background_color'            				=> '#121212', /* Footer Background Color */
				'main_text_color'             						=> '#333333', /* Main Text Color */
				'header_navigation_color'      	            		=> '#ffffff', /* Header Navigation Color */
				'header_navigation_hover_color'             		=> '#ffffff', /* Header Navigation Hover Color */
				'non_transparent_header_text_color'         		=> '#333333', /* Non Transparent Header Text Color */
				'non_transparent_nav_color'                 		=> '#111111', /* Non Transparent Nav Color */
				'non_transparent_nav_hover_color'           		=> '#ffbb4a', /* Non Transparent Nav Hover Color */
				'custom_header_slider_text_color'           		=> '#ffffff', /* Custom Header Slider Text Color */
				'heading_text_color'      							=> '#111111', /* Heading Text Color */
				'link_color'  										=> '#fa6742', /* Link Color  */
				'link_hover_color'    								=> '#ffbb4a', /* Link Hover Color */
				'secondary_link_color'              				=> '#111111', /* Secondary Link Color */
				'secondary_link_hover_color'              			=> '#ffbb4a', /* Secondary Link Hover Color */
				'tertiary_link_color'                				=> '#ffbb4a', /* Tertiary Link Color */
				'button_background_color'        					=> '#fa6742', /* Button Background Color */
				'button_text_color'        							=> '#ffffff', /* Button Text Color */
				'button_background_hover_color'        				=> '#333333', /* Button Background Hover Color */
				'button_text_hover_color'        					=> '#ffffff', /* Button Text Hover Color */
				'gradient_button_background_color_first'    	    => '#b99470', /* Gradient Button Background Color First */
				'gradient_button_background_color_first_next'   	=> '#fa6742', /* Gradient Button Background Color Second */
				'gradient_button_background_hover_color_first'      => '#fa6742', /* Gradient Button Background Hover Color First */
				'gradient_button_background_hover_color_first_next' => '#b99470', /* Gradient Button Background Hover Color Second */
				'border_color'             					        => '#e6e6e6', /* Border Color */
				'content_color_white'             			        => '#ffffff', /* Content Color White */
			),
		),
		'dark' => array( /* Dark */
			'label'  => esc_html__( 'Dark', 'wen-travel-pro' ),
			'colors' => array(
				'background_color'         							=> '#000000', /* Body Background Color */
				'header_textcolor' 						    		=> '#ffffff', /* Header Text Color */
				'primary_background_color'         					=> '#141414', /* Primary Background Color */
				'secondary_background_color'            			=> '#222222', /* Secondary Background Color */
				'tertiary_background_color'            				=> '#fa6742', /* Tertiary Background Color */
				'footer_background_color'            				=> '#121212', /* Footer Background Color */
				'main_text_color'             						=> '#999999', /* Main Text Color */
				'header_navigation_color'      	            		=> '#ffffff', /* Header Navigation Color */
				'header_navigation_hover_color'             		=> '#ffffff', /* Header Navigation Hover Color */
				'non_transparent_header_text_color'         		=> '#ffffff', /* Non Transparent Header Text Color */
				'non_transparent_nav_color'                 		=> '#ffffff', /* Non Transparent Nav Color */
				'non_transparent_nav_hover_color'           		=> '#ffbb4a', /* Non Transparent Nav Hover Color */
				'custom_header_slider_text_color'           		=> '#ffffff', /* Custom Header Slider Text Color */
				'heading_text_color'      							=> '#ffffff', /* Heading Text Color */
				'link_color'  										=> '#fa6742', /* Link Color  */
				'link_hover_color'    								=> '#ffbb4a', /* Link Hover Color */
				'secondary_link_color'              				=> '#ffffff', /* Secondary Link Color */
				'secondary_link_hover_color'              			=> '#ffbb4a', /* Secondary Link Hover Color */
				'tertiary_link_color'                				=> '#ffbb4a', /* Tertiary Link Color */
				'button_background_color'        					=> '#fa6742', /* Button Background Color */
				'button_text_color'        							=> '#ffffff', /* Button Text Color */
				'button_background_hover_color'        				=> '#6a6a6a', /* Button Background Hover Color */
				'button_text_hover_color'        					=> '#ffffff', /* Button Text Hover Color */
				'gradient_button_background_color_first'    		=> '#b99470', /* Gradient Button Background Color First */
				'gradient_button_background_color_first_next'   	=> '#fa6742', /* Gradient Button Background Color Second */
				'gradient_button_background_hover_color_first' 		=> '#fa6742', /* Gradient Button Background Hover Color First */
				'gradient_button_background_hover_color_first_next' => '#b99470', /* Gradient Button Background Hover Color Second */
				'border_color'             							=> '#353535', /* Border Color */
				'content_color_white'             					=> '#ffffff', /* Content Color White */
			),
		),
		'blog' => array( /* Blog */
			'label'  => esc_html__( 'Blog', 'wen-travel-pro' ),
			'colors' => array(
				'background_color'         							=> '#ffffff', /* Body Background Color */
				'header_textcolor' 						    		=> '#ffffff', /* Header Text Color */
				'primary_background_color'         					=> '#ffffff', /* Primary Background Color */
				'secondary_background_color'            			=> '#f6f6f6', /* Secondary Background Color */
				'tertiary_background_color'            				=> '#061d55', /* Tertiary Background Color */
				'footer_background_color'            				=> '#121212', /* Footer Background Color */
				'main_text_color'             						=> '#333333', /* Main Text Color */
				'header_navigation_color'      	            		=> '#ffffff', /* Header Navigation Color */
				'header_navigation_hover_color'             		=> '#ffffff', /* Header Navigation Hover Color */
				'non_transparent_header_text_color'         		=> '#333333', /* Non Transparent Header Text Color */
				'non_transparent_nav_color'                 		=> '#111111', /* Non Transparent Nav Color */
				'non_transparent_nav_hover_color'           		=> '#b99470', /* Non Transparent Nav Hover Color */
				'custom_header_slider_text_color'           		=> '#ffffff', /* Custom Header Slider Text Color */
				'heading_text_color'      							=> '#111111', /* Heading Text Color */
				'link_color'  										=> '#b99470', /* Link Color  */
				'link_hover_color'    								=> '#ffbb4a', /* Link Hover Color */
				'secondary_link_color'              				=> '#111111', /* Secondary Link Color */
				'secondary_link_hover_color'              			=> '#ffbb4a', /* Secondary Link Hover Color */
				'tertiary_link_color'                				=> '#ffbb4a', /* Tertiary Link Color */
				'button_background_color'        					=> '#b99470', /* Button Background Color */
				'button_text_color'        							=> '#ffffff', /* Button Text Color */
				'button_background_hover_color'        				=> '#333333', /* Button Background Hover Color */
				'button_text_hover_color'        					=> '#ffffff', /* Button Text Hover Color */
				'gradient_button_background_color_first'    		=> '#fa6742', /* Gradient Button Background Color First */
				'gradient_button_background_color_first_next'   	=> '#b99470', /* Gradient Button Background Color Second */
				'gradient_button_background_hover_color_first'  	=> '#b99470', /* Gradient Button Background Hover Color First */
				'gradient_button_background_hover_color_first_next' => '#fa6742', /* Gradient Button Background Hover Color Second */
				'border_color'             							=> '#e6e6e6', /* Border Color */
				'content_color_white'             					=> '#ffffff', /* Content Color White */
			),
		),
		'photography' => array( /* Photography */
			'label'  => esc_html__( 'Photography', 'wen-travel-pro' ),
			'colors' => array(
				'background_color'         							=> '#000000', /* Body Background Color */
				'header_textcolor' 						    		=> '#ffffff', /* Header Text Color */
				'primary_background_color'         					=> '#141414', /* Primary Background Color */
				'secondary_background_color'            			=> '#222222', /* Secondary Background Color */
				'tertiary_background_color'            				=> '#fa6742', /* Tertiary Background Color */
				'footer_background_color'            				=> '#121212', /* Footer Background Color */
				'main_text_color'             						=> '#999999', /* Main Text Color */
				'header_navigation_color'      	            		=> '#ffffff', /* Header Navigation Color */
				'header_navigation_hover_color'             		=> '#ffffff', /* Header Navigation Hover Color */
				'non_transparent_header_text_color'         		=> '#ffffff', /* Non Transparent Header Text Color */
				'non_transparent_nav_color'                 		=> '#ffffff', /* Non Transparent Nav Color */
				'non_transparent_nav_hover_color'           		=> '#ffbb4a', /* Non Transparent Nav Hover Color */
				'custom_header_slider_text_color'           		=> '#ffffff', /* Custom Header Slider Text Color */
				'heading_text_color'      							=> '#ffffff', /* Heading Text Color */
				'link_color'  										=> '#cd5087', /* Link Color  */
				'link_hover_color'    								=> '#ffbb4a', /* Link Hover Color */
				'secondary_link_color'              				=> '#ffffff', /* Secondary Link Color */
				'secondary_link_hover_color'              			=> '#ffbb4a', /* Secondary Link Hover Color */
				'tertiary_link_color'                				=> '#ffbb4a', /* Tertiary Link Color */
				'button_background_color'        					=> '#cd5087', /* Button Background Color */
				'button_text_color'        							=> '#ffffff', /* Button Text Color */
				'button_background_hover_color'        				=> '#6a6a6a', /* Button Background Hover Color */
				'button_text_hover_color'        					=> '#ffffff', /* Button Text Hover Color */
				'gradient_button_background_color_first'    		=> '#f15f79', /* Gradient Button Background Color First */
				'gradient_button_background_color_first_next'   	=> '#b24592', /* Gradient Button Background Color Second */
				'gradient_button_background_hover_color_first'  	=> '#b24592', /* Gradient Button Background Hover Color First */
				'gradient_button_background_hover_color_first_next' => '#f15f79', /* Gradient Button Background Hover Color Second */
				'border_color'             							=> '#353535', /* Border Color */
				'content_color_white'             					=> '#ffffff', /* Content Color White */
			),
		),
		'corporate' => array( /* Corporate */
			'label'  => esc_html__( 'Corporate', 'wen-travel-pro' ),
			'colors' => array(
				'background_color'         							=> '#ffffff', /* Body Background Color */
				'header_textcolor' 						    		=> '#ffffff', /* Header Text Color */
				'primary_background_color'         					=> '#ffffff', /* Primary Background Color */
				'secondary_background_color'            			=> '#f6f6f6', /* Secondary Background Color */
				'tertiary_background_color'            				=> '#1c1c1c', /* Tertiary Background Color */
				'footer_background_color'            				=> '#121212', /* Footer Background Color */
				'main_text_color'             						=> '#333333', /* Main Text Color */
				'header_navigation_color'      	            		=> '#ffffff', /* Header Navigation Color */
				'header_navigation_hover_color'             		=> '#ffffff', /* Header Navigation Hover Color */
				'non_transparent_header_text_color'         		=> '#333333', /* Non Transparent Header Text Color */
				'non_transparent_nav_color'                 		=> '#111111', /* Non Transparent Nav Color */
				'non_transparent_nav_hover_color'           		=> '#b99470', /* Non Transparent Nav Hover Color */
				'custom_header_slider_text_color'           		=> '#ffffff', /* Custom Header Slider Text Color */
				'heading_text_color'      							=> '#111111', /* Heading Text Color */
				'link_color'  										=> '#b99470', /* Link Color  */
				'link_hover_color'    								=> '#ffbb4a', /* Link Hover Color */
				'secondary_link_color'              				=> '#111111', /* Secondary Link Color */
				'secondary_link_hover_color'              			=> '#ffbb4a', /* Secondary Link Hover Color */
				'tertiary_link_color'                				=> '#b99470', /* Tertiary Link Color */
				'button_background_color'        					=> '#b99470', /* Button Background Color */
				'button_text_color'        							=> '#ffffff', /* Button Text Color */
				'button_background_hover_color'        				=> '#333333', /* Button Background Hover Color */
				'button_text_hover_color'        					=> '#ffffff', /* Button Text Hover Color */
				'gradient_button_background_color_first'    		=> '#fa6742', /* Gradient Button Background Color First */
				'gradient_button_background_color_first_next'   	=> '#b99470', /* Gradient Button Background Color Second */
				'gradient_button_background_hover_color_first'  	=> '#b99470', /* Gradient Button Background Hover Color First */
				'gradient_button_background_hover_color_first_next' => '#fa6742', /* Gradient Button Background Hover Color Second */
				'border_color'             							=> '#e6e6e6', /* Border Color */
				'content_color_white'             					=> '#ffffff', /* Content Color White */
			),
		),
	) );
}

if ( ! function_exists( 'wen_travel_get_color_scheme' ) ) :
/**
 * Retrieves the current Zubin color scheme.
 *
 * Create your own wen_travel_get_color_scheme() function to override in a child theme.
 *
 * @since 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function wen_travel_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = wen_travel_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // wen_travel_get_color_scheme

if ( ! function_exists( 'wen_travel_get_color_scheme_choices' ) ) :
	/**
	 * Retrieves an array of color scheme choices registered for Zubin.
	 *
	 * Create your own wen_travel_get_color_scheme_choices() function to override
	 * in a child theme.
	 *
	 * @since 1.0
	 *
	 * @return array Array of color schemes.
	 */
	function wen_travel_get_color_scheme_choices() {
		$color_schemes                = wen_travel_get_color_schemes();
		$color_scheme_control_options = array();

		foreach ( $color_schemes as $color_scheme => $value ) {
			$color_scheme_control_options[ $color_scheme ] = $value['label'];
		}

		return $color_scheme_control_options;
	}
endif; // wen_travel_get_color_scheme_choices

/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since 1.0
 */
function wen_travel_customize_control_js() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script( 'wen-travel-color-scheme-control', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/color-scheme-control' . $min . '.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), date( 'Ymd-Gis', filemtime( get_template_directory() . '/' .  'js/color-scheme-control' . $min . '.js' ) ), true );

	$colors['colorScheme'] = wen_travel_get_color_schemes();

	$color_options = wen_travel_color_options();

    $color_options = array_merge( array( 'background_color', 'header_textcolor' ), array_keys( $color_options ) );

	$colors['colorOptions'] = $color_options;

	wp_localize_script( 'wen-travel-color-scheme-control', 'wenTravelColorMain', $colors );

	wp_enqueue_script( 'wen-travel-custom-controls', trailingslashit( esc_url( get_template_directory_uri() ) ) . 'js/customize-custom-controls' . $min . '.js', array( 'jquery-ui-sortable' ), date( 'Ymd-Gis', filemtime( get_template_directory() . '/' .  'js/customize-custom-controls' . $min . '.js' ) ), true );

	wp_enqueue_style( 'wen-travel-custom-controls-css', trailingslashit( esc_url( get_template_directory_uri() ) ) . '/css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'wen_travel_customize_control_js' );

/**
 * Enqueues front-end CSS for custom colors.
 *
 * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function wen_travel_all_color_css() {
	$color_schemes  = wen_travel_get_color_schemes();
	$color_scheme  = $color_schemes['default']['colors'];

	$css = '';

	$colors = wen_travel_color_options();

	$next = '';

	foreach ( $colors as $key => $color ) {
		if ( $next === $key ) {
			// Bail the loop if $next is encountered as its value is next value for gradient and it has already been used.
			continue;
		}

		$default_color = $color_scheme[ $key ];

		$value = get_theme_mod( $key, $default_color );

		if ( isset( $color['is_gradient'] ) && $color['is_gradient'] ) {
			$next = $key . '_next';

			$default_color2 = $color_scheme[ $next  ];

			$value2 = get_theme_mod( $next, $default_color2 );

			if ( $value === $default_color && $value2 === $default_color2 ) {
				continue;
			}

			$css .= sprintf( $color['css'], esc_attr( $value ), esc_attr( $value2 ) );
		} else {
			if ( $value === $default_color ) {
				continue;
			}

			$css .= sprintf( $color['css'], esc_attr( $value ) );
		}
	}

	if ( $css ) {
		wp_add_inline_style( 'wen-travel-block-style', $css );
	}
}
add_action( 'wp_enqueue_scripts', 'wen_travel_all_color_css', 11 );

/**
 * Enqueues front-end CSS for the Contact and Newsletter background color
 *
 * @since 1.0
 *
 * @see wp_add_inline_style()
 */

/**
 * Converts a HEX value to RGB.
 *
 * @since 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function wen_travel_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}
