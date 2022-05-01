<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION



if ( !function_exists( 'awesome_portfolio_parent_css' ) ):
    function awesome_portfolio_parent_css() {

        $themeVersion = wp_get_theme()->get('Version');
        
        wp_enqueue_style( 'awesome-portfolio-style-vars', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/css-vars.css',array(),$themeVersion);
        wp_enqueue_style( 'awesome-portfolio-parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'font-awesome','cww-portfolio-keyboard' ),$themeVersion );
        wp_enqueue_style('awesome-portfolio-style', trailingslashit( get_template_directory_uri() ) . '/style.css',array(), $themeVersion);


    }
endif;
add_action( 'wp_enqueue_scripts', 'awesome_portfolio_parent_css' );



if ( !function_exists( 'awesome_portfolio_parent_modify_css' ) ):
    function awesome_portfolio_parent_modify_css() {

        $themeVersion = wp_get_theme()->get('Version');
        wp_deregister_style('cww-portfolio-style-vars');
        wp_enqueue_style('awesome-portfolio-responsive', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/responsive-style.css',array(), $themeVersion);
        
    }
endif;
add_action( 'wp_enqueue_scripts', 'awesome_portfolio_parent_modify_css',20 );





// END ENQUEUE PARENT ACTION


/**
 * Theme Option Default Values
 * 
 * 
 * 
 */ 
add_filter('cww_portfolio_default_theme_options','awesome_portfolio_customizer_defaults');
if( ! function_exists('awesome_portfolio_customizer_defaults')):
    function awesome_portfolio_customizer_defaults(){

        $defaults = array();

        $defaults['cww_home_banner']                    = 0;
        $defaults['cww_header_cta_enable']              = 0;
        $defaults['cww_header_cta_text']                = esc_html__('Contact Now','awesome-portfolio');
        $defaults['cww_header_cta_url']                 = '#';
        $defaults['cww_header_cta_bg']                  = '#6138bd';
        $defaults['cww_header_bg']                      = '#fff';
        $defaults['cww_menu_link_color']                = '#11204d';
        $defaults['cww_menu_link_color_hover']          = '';
        $defaults['cww_icon_fb']                        = '';
        $defaults['cww_icon_insta']                     = '';
        $defaults['cww_icon_twitter']                   = '';
        $defaults['cww_icon_lnkedin']                   = '';
        $defaults['cww_theme_color']                    = '#54CFD4';

        $defaults['cww_banner_image']                   = '';
        $defaults['cww_banner_text_sm']                 = esc_html__("Hi There, I'm",'awesome-portfolio');
        $defaults['cww_banner_text_lg']                 = esc_html__('John Doe','awesome-portfolio');
        $defaults['cww_banner_text_sm2']                = esc_html__('based in Los Angeles, USA','awesome-portfolio');
        $defaults['cww_banner_btn_text']                = esc_html__('View My Works','awesome-portfolio');
        $defaults['cww_banner_btn_url']                 = '#';
        $defaults['cww_banner_btn_text_sec']            = esc_html__('Contact Me','awesome-portfolio');
        $defaults['cww_banner_btn_url_sec']             = '#';
        $defaults['cww_banner_bg']                      = 'rgba(108,85,224, 0.1)';
        $defaults['cww_banner_animated_color']          = '#54CFD4';

        $defaults['cww_about_title']                    = esc_html__('About Me','awesome-portfolio');
        $defaults['cww_about_sub_title']                = '';
        $defaults['cww_about_image']                    = '';
        $defaults['cww_about_counter_value_first']      = 155;
        $defaults['cww_about_counter_text_first']       = esc_html__('Completed projects','awesome-portfolio');
        $defaults['cww_about_counter_value_sec']        = 120;
        $defaults['cww_about_counter_text_sec']         = esc_html__('Positive reviews','awesome-portfolio');


        $defaults['cww_service_title']                  = esc_html__('What We Offer','awesome-portfolio');
        $defaults['cww_service_sub_title']              = '';
        $defaults['cww_portfolio_title']                = esc_html__('Our Portfolio','awesome-portfolio');
        $defaults['cww_portfolio_sub_title']            = '';
        $defaults['cww_portfolio_post']                 = 0;

        $defaults['cww_service_enable']                 = 1;
        $defaults['cww_portfolio_enable']               = 1;
        $defaults['cww_blog_enable']                    = 1;
        $defaults['cww_contact_enable']                 = 1;
        $defaults['cww_cta_enable']                     = 1;
        $defaults['cww_about_enable']                   = 1;
        

        
        return $defaults;
    }
endif;