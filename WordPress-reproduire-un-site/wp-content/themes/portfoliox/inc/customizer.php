<?php

/**
 * PortfolioX Theme Customizer
 *
 * @package PortfolioX
 */



/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function portfoliox_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    //select sanitization function
    function portfoliox_sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }
    function portfoliox_sanitize_image($file, $setting)
    {
        $mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png',
            'bmp'          => 'image/bmp',
            'tif|tiff'     => 'image/tiff',
            'ico'          => 'image/x-icon'
        );
        //check file type from file name
        $file_ext = wp_check_filetype($file, $mimes);
        //if file has a valid mime type return it, otherwise return default
        return ($file_ext['ext'] ? $file : $setting->default);
    }

    $wp_customize->add_setting('portfoliox_site_tagline_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_site_tagline_show', array(
        'label'      => __('Hide Site Tagline Only? ', 'portfoliox'),
        'section'    => 'title_tagline',
        'settings'   => 'portfoliox_site_tagline_show',
        'type'       => 'checkbox',

    ));

    $wp_customize->add_panel('portfoliox_settings', array(
        'priority'       => 50,
        'title'          => __('PortfolioX Theme settings', 'portfoliox'),
        'description'    => __('All PortfolioX theme settings', 'portfoliox'),
    ));
    $wp_customize->add_section('portfoliox_header', array(
        'title' => __('PortfolioX Header Settings', 'portfoliox'),
        'capability'     => 'edit_theme_options',
        'description'     => __('PortfolioX theme header settings', 'portfoliox'),
        'panel'    => 'portfoliox_settings',

    ));
    $wp_customize->add_setting('portfoliox_main_menu_style', array(
        'default'        => 'style1',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfoliox_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_main_menu_style', array(
        'label'      => __('Main Menu Style', 'portfoliox'),
        'description' => __('You can set the menu style one or two. ', 'portfoliox'),
        'section'    => 'portfoliox_header',
        'settings'   => 'portfoliox_main_menu_style',
        'type'       => 'select',
        'choices'    => array(
            'style1' => __('Style One', 'portfoliox'),
            'style2' => __('Style Two', 'portfoliox'),
        ),
    ));

    //portfoliox Home intro
    $wp_customize->add_section('portfoliox_intro', array(
        'title' => __('Portfolio Intro Settings', 'portfoliox'),
        'capability'     => 'edit_theme_options',
        'description'     => __('Portfoli profile Intro Settings', 'portfoliox'),
        'panel'    => 'portfoliox_settings',

    ));
    $wp_customize->add_setting('portfoliox_intro_img', array(
        'capability'        => 'edit_theme_options',
        'default'           => '',
        'sanitize_callback' => 'portfoliox_sanitize_image',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'portfoliox_intro_img',
        array(
            'label'    => __('Upload Profile Image', 'portfoliox'),
            'description'    => __('Image size should be 450px width & 460px height for better view.', 'portfoliox'),
            'section'  => 'portfoliox_intro',
            'settings' => 'portfoliox_intro_img',
        )
    ));
    $wp_customize->add_setting('portfoliox_intro_subtitle', array(
        'default' => __('WELCOME TO MY WORLD', 'portfoliox'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_intro_subtitle', array(
        'label'      => __('Intro Subtitle', 'portfoliox'),
        'section'    => 'portfoliox_intro',
        'settings'   => 'portfoliox_intro_subtitle',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('portfoliox_intro_title', array(
        'default' => __('Hi, I\'m Jone Doe', 'portfoliox'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_intro_title', array(
        'label'      => __('Intro Title', 'portfoliox'),
        'section'    => 'portfoliox_intro',
        'settings'   => 'portfoliox_intro_title',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('portfoliox_intro_designation', array(
        'default' => __('a Designer', 'portfoliox'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_intro_designation', array(
        'label'      => __('Designation', 'portfoliox'),
        'section'    => 'portfoliox_intro',
        'settings'   => 'portfoliox_intro_designation',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('portfoliox_intro_desc', array(
        'default' => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_intro_desc', array(
        'label'      => __('Intro Description', 'portfoliox'),
        'section'    => 'portfoliox_intro',
        'settings'   => 'portfoliox_intro_desc',
        'type'       => 'textarea',
    ));
    $wp_customize->add_setting('portfoliox_btn_text_one', array(
        'default' => __('Hire me', 'portfoliox'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('portfoliox_btn_text_one', array(
        'label'      => __('Button one text', 'portfoliox'),
        'section'    => 'portfoliox_intro',
        'settings'   => 'portfoliox_btn_text_one',
        'type'       => 'text',
    ));

    $wp_customize->add_setting('portfoliox_btn_url_one', array(
        'default' => '#',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_btn_url_one', array(
        'label'      => __('Button one url', 'portfoliox'),
        'description'      => __('Keep url empty for hide this button', 'portfoliox'),
        'section'    => 'portfoliox_intro',
        'settings'   => 'portfoliox_btn_url_one',
        'type'       => 'url',
    ));
    $wp_customize->add_setting('portfoliox_btn_text_two', array(
        'default'     => __('Download CV', 'portfoliox'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('portfoliox_btn_text_two', array(
        'label'      => __('Button two text', 'portfoliox'),
        'section'    => 'portfoliox_intro',
        'settings'   => 'portfoliox_btn_text_two',
        'type'       => 'text',
    ));

    $wp_customize->add_setting('portfoliox_btn_url_two', array(
        'default' => '#',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_btn_url_two', array(
        'label'      => __('Button two url', 'portfoliox'),
        'description'      => __('Keep url empty for hide this button', 'portfoliox'),
        'section'    => 'portfoliox_intro',
        'settings'   => 'portfoliox_btn_url_two',
        'type'       => 'text',
    ));

    //portfoliox blog settings
    $wp_customize->add_section('portfoliox_blog', array(
        'title' => __('PortfolioX Blog Settings', 'portfoliox'),
        'capability'     => 'edit_theme_options',
        'description'     => __('PortfolioX theme blog settings', 'portfoliox'),
        'panel'    => 'portfoliox_settings',

    ));
    $wp_customize->add_setting('portfoliox_blog_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfoliox_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_blog_container', array(
        'label'      => __('Container type', 'portfoliox'),
        'description' => __('You can set standard container or full width container. ', 'portfoliox'),
        'section'    => 'portfoliox_blog',
        'settings'   => 'portfoliox_blog_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Container', 'portfoliox'),
            'container-fluid' => __('Full width Container', 'portfoliox'),
        ),
    ));
    $wp_customize->add_setting('portfoliox_blog_layout', array(
        'default'        => 'fullwidth',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfoliox_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_blog_layout', array(
        'label'      => __('Select Blog Layout', 'portfoliox'),
        'description' => __('Right and Left sidebar only show when sidebar widget is available. ', 'portfoliox'),
        'section'    => 'portfoliox_blog',
        'settings'   => 'portfoliox_blog_layout',
        'type'       => 'select',
        'choices'    => array(
            'rightside' => __('Right Sidebar', 'portfoliox'),
            'leftside' => __('Left Sidebar', 'portfoliox'),
            'fullwidth' => __('No Sidebar', 'portfoliox'),
        ),
    ));
    $wp_customize->add_setting('portfoliox_blog_style', array(
        'default'        => 'grid',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfoliox_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_blog_style', array(
        'label'      => __('Select Blog Style', 'portfoliox'),
        'section'    => 'portfoliox_blog',
        'settings'   => 'portfoliox_blog_style',
        'type'       => 'select',
        'choices'    => array(
            'grid' => __('Grid Style', 'portfoliox'),
            'classic' => __('Classic Style', 'portfoliox'),
        ),
    ));
    //portfoliox page settings
    $wp_customize->add_section('portfoliox_page', array(
        'title' => __('PortfolioX Page Settings', 'portfoliox'),
        'capability'     => 'edit_theme_options',
        'description'     => __('PortfolioX theme blog settings', 'portfoliox'),
        'panel'    => 'portfoliox_settings',

    ));
    $wp_customize->add_setting('portfoliox_page_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfoliox_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_page_container', array(
        'label'      => __('Page Container type', 'portfoliox'),
        'description' => __('You can set standard container or full width container for page. ', 'portfoliox'),
        'section'    => 'portfoliox_page',
        'settings'   => 'portfoliox_page_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Container', 'portfoliox'),
            'container-fluid' => __('Full width Container', 'portfoliox'),
        ),
    ));
    $wp_customize->add_setting('portfoliox_page_header', array(
        'default'        => 'show',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfoliox_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_page_header', array(
        'label'      => __('Show Page header', 'portfoliox'),
        'section'    => 'portfoliox_page',
        'settings'   => 'portfoliox_page_header',
        'type'       => 'select',
        'choices'    => array(
            'show' => __('Show all pages', 'portfoliox'),
            'hide-home' => __('Hide Only Front Page', 'portfoliox'),
            'hide' => __('Hide All Pages', 'portfoliox'),
        ),
    ));




    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'portfoliox_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'portfoliox_customize_partial_blogdescription',
            )
        );
    }
}
add_action('customize_register', 'portfoliox_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function portfoliox_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function portfoliox_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function portfoliox_customize_preview_js()
{
    wp_enqueue_script('portfoliox-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), PORTFOLIOX_VERSION, true);
}
add_action('customize_preview_init', 'portfoliox_customize_preview_js');
