<?php

#-----------------------------------------------------------------#
# Theme Initial Setup
#-----------------------------------------------------------------#

add_action( 'after_setup_theme', 'ptf_setup' );

if ( !function_exists('ptf_setup') ) {

    function ptf_setup() {

        load_theme_textdomain( 'artcore', PTF_FRAMEWORK_DIRECTORY . '/languages' );
        
        // Add support for thumbnails and define default sizes
        add_theme_support('post-thumbnails');
        add_image_size('ptf-project-thumb', 840, 525, true);
        add_image_size('ptf-blog-classic-thumb', 730, 395, true);
        add_image_size('ptf-blog-grid-thumb', 600, 400, true);
        add_image_size('ptf-sidebar-thumb', 70, 50, true);
        add_image_size('ptf-sidebar-project-thumb', 75, 75, true);

        // Add RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');

        // This theme uses wp_nav_menu() in one locations.
        register_nav_menus(array(
            'header_main_menu' => __('Header Main Menu', 'artcore'),
        ));

        // Outputs valid HTML5 for several page elements
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));

        // Adds support for WordPress generated <title> tag
        add_theme_support('title-tag');
    }

}

#-----------------------------------------------------------------#
# Enqueue Theme Scripts and Syles
#-----------------------------------------------------------------#

add_action( 'wp_enqueue_scripts', 'ptf_theme_scripts' );

function ptf_theme_scripts() {
    
    /* 
     * Register and Equeue CSS Files
     */
    
    // Load the Boostrap CSS file.
    wp_enqueue_style( 'ptf-bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), PTF_FRAMEWORK_THEME_VERSION );
    
     // Load the SimpleLine icons.
    wp_enqueue_style( 'ptf-simple-line-icons', get_template_directory_uri() . '/assets/css/simple-line-icons.css', array(), PTF_FRAMEWORK_THEME_VERSION );
    
    // Load the FontAwesome icons.
    wp_enqueue_style( 'ptf-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), PTF_FRAMEWORK_THEME_VERSION );
    
    // Load the Artcore main stylesheet.
    wp_enqueue_style( 'ptf-artcore', get_template_directory_uri() . '/assets/css/artcore.min.css', array(), PTF_FRAMEWORK_THEME_VERSION );
    
    // Load default WordPress stylesheet.
    wp_enqueue_style( 'ptf-main-styles', get_stylesheet_uri() );

    /* 
     * Register and Equeue JS Files
     */
    
    // Load Boostrap JS file
    wp_enqueue_script( 'ptf-bootstrap-js', get_template_directory_uri() . '/assets/js/min/bootstrap.min.js', array('jquery'), PTF_FRAMEWORK_THEME_VERSION , true);
    
    // Load jQuery plugins
    wp_enqueue_script( 'ptf-jquery-plugins', get_template_directory_uri() . '/assets/js/min/plugins.min.js', array('jquery'), PTF_FRAMEWORK_THEME_VERSION, true);

    // Load theme specific scripts
    wp_enqueue_script( 'ptf-theme-scripts', get_template_directory_uri() . '/assets/js/min/custom.min.js', array('jquery'), PTF_FRAMEWORK_THEME_VERSION, true);
    
    // Enable threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

#-----------------------------------------------------------------#
# Setup and Register Widgets Areas
#-----------------------------------------------------------------#

add_action( 'widgets_init', 'ptf_widgets_init' );

if ( !function_exists('ptf_widgets_init') ) {
	
    function ptf_widgets_init() {

        // Location: At the left side of pages
        register_sidebar(array(
            'name'          => __('Sidebar', 'artcore'),
            'id'            => 'ptf-sidebar-widget-area',
            'description'   => __( 'Located at the left side of pages.', 'artcore'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
        
        // Footer Widget
        // Location: at the top of the footer, above the copyright
        register_sidebar(array(
            'name'          => __('Footer Area 1', 'artcore'),
            'id'            => 'ptf-footer-area-1',
            'description'   => __( 'Located at the bottom of pages.', 'artcore'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));
        
        // Footer Widget
        // Location: at the top of the footer, above the copyright
        register_sidebar(array(
            'name'          => __('Footer Area 2', 'artcore'),
            'id'            => 'ptf-footer-area-2',
            'description'   => __( 'Located at the bottom of pages.', 'artcore'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));
        
        // Footer Widget
        // Location: at the top of the footer, above the copyright
        register_sidebar(array(
            'name'          => __('Footer Area 3', 'artcore'),
            'id'            => 'ptf-footer-area-3',
            'description'   => __( 'Located at the bottom of pages.', 'artcore'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));
        
        // Footer Widget
        // Location: at the top of the footer, above the copyright
        register_sidebar(array(
            'name'          => __('Footer Area 4', 'artcore'),
            'id'            => 'ptf-footer-area-4',
            'description'   => __( 'Located at the bottom of pages.', 'artcore'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));
    }
}