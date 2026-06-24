<?php

/**
 * Theme Setup
 */
function arsal_theme_setup() {

    // Title tag support
    add_theme_support('title-tag');

    // Featured images support
    add_theme_support('post-thumbnails');
	
	    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Register navigation menu
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'arsal')
    ));

    // ✅ Recommendation: Add custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // ✅ Recommendation: Add HTML5 support (clean markup)
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
}
add_action('after_setup_theme', 'arsal_theme_setup');


/**
 * Enqueue Styles
 */
function arsal_theme_styles() {

    // Normalize.css
    wp_enqueue_style(
        'normalize-styles',
        'https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css',
        array(),
        '7.0.0'
    );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
        array(),
        '5.15.4'
    );

    // Main style.css
    wp_enqueue_style(
        'arsal-style',
        get_stylesheet_uri(),
        array('normalize-styles'),
        wp_get_theme()->get('Version')
    );

    // Custom CSS (safe version)
    $custom_css = get_template_directory() . '/css/custom.css';

    wp_enqueue_style(
        'arsal-custom',
        get_template_directory_uri() . '/css/custom.css',
        array('arsal-style'),
        file_exists($custom_css) ? filemtime($custom_css) : '1.0'
    );
}
add_action('wp_enqueue_scripts', 'arsal_theme_styles');

function arsal_customize_register($wp_customize) {

    // Hero Section
    $wp_customize->add_section('arsal_hero_section', array(
        'title'    => 'Hero Section',
        'priority' => 20,
    ));

    // Hero Title
    $wp_customize->add_setting('arsal_hero_title', array(
        'default' => 'Property pivot Buyers',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('arsal_hero_title', array(
        'label' => 'Hero Title',
        'section' => 'arsal_hero_section',
        'type' => 'text',
    ));

    // Hero Description
    $wp_customize->add_setting('arsal_hero_desc', array(
        'default' => 'Your Trusted Partner in Navigating Real Estate Challenges...',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('arsal_hero_desc', array(
        'label' => 'Hero Description',
        'section' => 'arsal_hero_section',
        'type' => 'textarea',
    ));

    // Hero Button Text
    $wp_customize->add_setting('arsal_hero_button', array(
        'default' => 'Read More',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('arsal_hero_button', array(
        'label' => 'Button Text',
        'section' => 'arsal_hero_section',
        'type' => 'text',
    ));

    // Hero Background Image
    $wp_customize->add_setting('arsal_hero_bg', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'arsal_hero_bg', array(
        'label' => 'Hero Background Image',
        'section' => 'arsal_hero_section',
        'settings' => 'arsal_hero_bg',
    )));
}
add_action('customize_register', 'arsal_customize_register');

function arsal_customize_register_form($wp_customize) {

    // Hero Form Section
    $wp_customize->add_section('arsal_hero_form_section', array(
        'title'    => 'Hero Form Settings',
        'priority' => 25,
    ));

    // Name Field Label
    $wp_customize->add_setting('arsal_form_name_label', array(
        'default' => 'Enter your name',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('arsal_form_name_label', array(
        'label' => 'Name Field Label',
        'section' => 'arsal_hero_form_section',
        'type' => 'text',
    ));

    // Email Field Label
    $wp_customize->add_setting('arsal_form_email_label', array(
        'default' => 'Enter your email',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('arsal_form_email_label', array(
        'label' => 'Email Field Label',
        'section' => 'arsal_hero_form_section',
        'type' => 'text',
    ));

    // Phone Field Label
    $wp_customize->add_setting('arsal_form_phone_label', array(
        'default' => 'Enter your phone number',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('arsal_form_phone_label', array(
        'label' => 'Phone Field Label',
        'section' => 'arsal_hero_form_section',
        'type' => 'text',
    ));

    // Address Field Label
    $wp_customize->add_setting('arsal_form_address_label', array(
        'default' => 'Your property address',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('arsal_form_address_label', array(
        'label' => 'Address Field Label',
        'section' => 'arsal_hero_form_section',
        'type' => 'text',
    ));

    // Submit Button Text
    $wp_customize->add_setting('arsal_form_button_text', array(
        'default' => 'Get an Offer',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('arsal_form_button_text', array(
        'label' => 'Submit Button Text',
        'section' => 'arsal_hero_form_section',
        'type' => 'text',
    ));
}
add_action('customize_register', 'arsal_customize_register_form');

/**
 * Register Widgets
 */
function arsal_widgets_init() {
    // Sidebar widget
    register_sidebar(array(
        'name'          => __('Sidebar', 'arsal'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'arsal'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // Footer widget
    register_sidebar(array(
        'name'          => __('Footer', 'arsal'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'arsal'),
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'arsal_widgets_init');
