<?php
/**
 * Artcore Theme Customizer Configuration File
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

// Early exit if Kirki is not installed
if ( ! class_exists( 'Kirki' ) ) {
    return;
}

/*
 * Add Panels
 */

Kirki::add_panel( 'ptf_general_options', array(
    'priority'    => 10,
    'title'       => __( 'General', 'artcore' ),
    'description' => __( 'General options for favicon, layout and color accent choices.', 'artcore' ),
) );

Kirki::add_panel( 'ptf_typography_options', array(
    'priority'    => 10,
    'title'       => __( 'Typography', 'artcore' ),
    'description' => __( 'Options for body, headings and extras typograhy.', 'artcore' ),
) );

Kirki::add_panel( 'ptf_layout_options', array(
    'priority'    => 10,
    'title'       => __( 'Layout', 'artcore' ),
    'description' => __( 'Options for header, footer and misc layout settings.', 'artcore' ),
) );

/*
 * Add Sections
 */
Kirki::add_section( 'ptf_logo_options', array(
    'priority'    => 10,
    'title'       => __( 'Custom Logo', 'artcore' ),
    'description' => '',
    'panel'       => 'ptf_general_options', 
) );

// Only shows Favicon and Icon options when using WordPress below 4.3 version
if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) ) {
    Kirki::add_section( 'ptf_favicon_options', array(
        'priority'    => 10,
        'title'       => __( 'Custom Favicon & Icons', 'artcore' ),
        'description' => '',
        'panel'       => 'ptf_general_options', 
    ) );
}

Kirki::add_section( 'ptf_color_options', array(
    'priority'    => 10,
    'title'       => __( 'Colors', 'artcore' ),
    'description' => '',
    'panel'       => 'ptf_general_options', 
) );

Kirki::add_section( 'ptf_header_options', array(
    'priority'    => 10,
    'title'       => __( 'Header', 'artcore' ),
    'description' => '',
    'panel'       => 'ptf_layout_options', 
) );

Kirki::add_section( 'ptf_footer_options', array(
    'priority'    => 10,
    'title'       => __( 'Footer', 'artcore' ),
    'description' => '',
    'panel'       => 'ptf_layout_options', 
) );

Kirki::add_section( 'ptf_body_font_options', array(
    'priority'    => 10,
    'title'       => __( 'Body', 'artcore' ),
    'description' => '',
    'panel'       => 'ptf_typography_options', 
) );

Kirki::add_section( 'ptf_heading_font_options', array(
    'priority'    => 10,
    'title'       => __( 'Headings', 'artcore' ),
    'description' => '',
    'panel'       => 'ptf_typography_options', 
) );

Kirki::add_section( 'ptf_extra_font_options', array(
    'priority'    => 10,
    'title'       => __( 'Extras', 'artcore' ),
    'description' => __( 'Tpography for Extra Elements.', 'artcore' ),
    'panel'       => 'ptf_typography_options', 
) );

Kirki::add_section( 'ptf_blog_options', array(
    'priority'    => 10,
    'title'       => __( 'Blog Settings', 'artcore' ),
    'description' => '',
) );

Kirki::add_section( 'ptf_projects_options', array(
    'priority'    => 10,
    'title'       => __( 'Project Settings', 'artcore' ),
    'description' => '',
) );

Kirki::add_section( 'ptf_social_options', array(
    'priority'    => 10,
    'title'       => __( 'Social Networks', 'artcore' ),
    'description' => '',
) );

Kirki::add_section( 'ptf_custom_code_options', array(
    'priority'    => 10,
    'title'       => __( 'Custom Code Integration', 'artcore' ),
    'description' => '',
) );

/**
 * Add General Controls
 */
function ptf_general_controls_fields( $fields ) {

    // Logo Fields
    $fields[] = array(
        'type'        => 'upload',
        'settings'    => 'ptf_logo',
        'label'       => '',
        'description' => __( 'Click the button below to upload a custom logo.', 'artcore' ),
        'help'        => __( 'Upload a logo with prefered sizes of 394x74.', 'artcore' ),
        'section'     => 'ptf_logo_options',
        'default'     => get_template_directory_uri() . '/assets/images/logo.png',
        'priority'    => 10,
    );
    
    // Only shows Favicon and Icon options when using WordPress below 4.3 version
    if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) ) {
        
        // Favicon Fields
        $fields[] = array(
            'type'        => 'upload',
            'settings'    => 'ptf_favicon',
            'label'       => __( 'Favicon', 'artcore' ),
            'description' => __( 'Upload a custom favicon.', 'artcore' ),
            'help'        => __( 'Upload a file( png, ico, jpg, gif or bmp ) from your computer (maximum size:1MB ).', 'artcore' ),
            'section'     => 'ptf_favicon_options',
            'default'     => get_template_directory_uri() . '/assets/images/icons/favicon.ico',
            'priority'    => 10,
        );
    
        // Icon Fields
        $fields[] = array(
            'type'        => 'upload',
            'settings'    => 'ptf_touch_icon_72',
            'label'       => __( 'Apple Touch Icon', 'artcore' ),
            'description' => __( 'Upload your touch icon here.', 'artcore' ),
            'help'        => '',
            'section'     => 'ptf_favicon_options',
            'default'     => get_template_directory_uri() . '/assets/images/icons/apple-touch-icon72.png',
            'priority'    => 10,
        );
    
         // Icon Fields
        $fields[] = array(
            'type'        => 'upload',
            'settings'    => 'ptf_touch_icon_144',
            'label'       => __( 'Apple Touch Icon 144x144', 'artcore' ),
            'description' => __( 'Upload your touch icon here.', 'artcore' ),
            'help'        => '',
            'section'     => 'ptf_favicon_options',
            'default'     => get_template_directory_uri() . '/assets/images/icons/apple-touch-icon144.png',
            'priority'    => 10,
        );
        
    }
    
    // Accent Color
    $fields[] = array(
        'type'        => 'color',
        'settings'    => 'ptf_accent_color',
        'label'       => __( 'Accent Color', 'artcore' ),
        'description' => __( 'Choose your prefered accent color.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_color_options',
        'default'     => '#e6772e',
        'priority'    => 10,
    );
    
    // Accent Hover Color
    $fields[] = array(
        'type'        => 'color',
        'settings'    => 'ptf_accent_hover_color',
        'label'       => __( 'Accent Hover Color', 'artcore' ),
        'description' => __( 'Choose your prefered accent hover color.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_color_options',
        'default'     => '#eb955c',
        'priority'    => 10,      
    );
    
    return $fields;
}

add_filter( 'kirki/fields', 'ptf_general_controls_fields' );

/**
 * Add Layout Controls
 */
function ptf_layout_controls_fields( $fields ) {
    
    // Show/Hide Search Icon
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'ptf_show_hide_search_icon',
        'label'       => __( 'Header Search Icon', 'artcore' ),
        'description' => __( 'Check this option to show/hide the header search icon.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_header_options',
        'default'     => '1',
        'priority'    => 10,
    );
    
    // Header Top Text
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_header_top_text',
        'label'       => __( 'Header Top Default Text', 'artcore' ),
        'description' => __( 'Enter your text below to show in the header top bar.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_header_options',
        'default'     => __( 'Welcome to Artcore.', 'artcore' ),
        'priority'    => 10,
    );
    
    // Footer Copyright Text
    $fields[] = array(
        'type'        => 'textarea',
        'settings'    => 'ptf_footer_text',
        'label'       => __( 'Footer Copyright Text', 'artcore' ),
        'description' => __( 'Enter your footer copyright text below.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_footer_options',
        'default'     => __( '2015 Artcore Creative Architecture WordPress Theme', 'artcore' ),
        'priority'    => 10,
    );

    return $fields;
}

add_filter( 'kirki/fields', 'ptf_layout_controls_fields' );

/**
 * Add Typography Controls
 */
function ptf_typography_controls_fields( $fields ) {
    
    // Body Font Family
    $fields[] = array(
        'type'     => 'select',
        'settings'  => 'ptf_body_font',
        'label'    => __( 'Font Family', 'artcore' ),
        'section'  => 'ptf_body_font_options',
        'default'  => 'Roboto',
        'priority' => 10,
        'choices'  => Kirki_Fonts::get_font_choices(),
        'output' => array(
            'element'  => 'body',
            'property' => 'font-family',
         ),
    );
    
    // Body Font Subset
    $fields[] = array(
        'type'     => 'select',
        'settings'  => 'ptf_body_font_subsets',
        'label'    => __( 'Google Font subsets', 'artcore' ),
        'description' => __( 'The subsets used from Google\'s API.', 'artcore' ),
        'section'  => 'ptf_body_font_options',
        'default'  => 'latin',
        'priority' => 10,
        'choices'  => Kirki_Fonts::get_google_font_subsets(),
        'output' => array(
            'element'  => 'body',
            'property' => 'font-subset',
        ),
    );
    
    // Body Font Weight
    $fields[] = array(
        'type'     => 'slider',
        'settings'  => 'ptf_body_font_weight',
        'label'    => __( 'Font Weight', 'artcore' ),
        'section'  => 'ptf_body_font_options',
        'default'  => 400,
        'priority' => 10,
        'choices'  => array(
            'min'  => 100,
            'max'  => 900,
            'step' => 100,
        ),
        'output' => array(
            'element'  => 'body',
            'property' => 'font-weight',
        ),
    );
    
    // Body Font Size
    $fields[] = array(
        'type'     => 'slider',
        'settings'  => 'ptf_body_font_size',
        'label'    => __( 'Font Size', 'artcore' ),
        'section'  => 'ptf_body_font_options',
        'default'  => 15,
        'priority' => 10,
        'choices'  => array(
            'min'  => 7,
            'max'  => 48,
            'step' => 1,
        ),
        'output' => array(
            'element'  => 'body',
            'property' => 'font-size',
            'units'    => 'px',
        ),
        'transport'   => 'postMessage',
        'js_vars'     => array(
            array(
                'element'  => 'body',
                'function' => 'css',
                'property' => 'font-size',
                'units'    => 'px'
            ),
        ),
    );
    
    // Headings Font Family
    $fields[] = array(
        'type'     => 'select',
        'settings'  => 'ptf_heading_font_family',
        'label'    => __( 'H1 - h6 Typography', 'artcore' ),
        'description' => __( 'Choose a font family for headings below.', 'artcore' ),
        'section'  => 'ptf_heading_font_options',
        'default'  => 'Montserrat',
        'priority' => 10,
        'choices'  => Kirki_Fonts::get_font_choices(),
        'output' => array(
            'element'  => 'h1,h2,h3,h4,h5,h6',
            'property' => 'font-family',
        ),
    );
    
    // Headings Font Weight
    $fields[] = array(
        'type'     => 'slider',
        'settings'  => 'ptf_heading_font_weight',
        'label'    => __( 'Font Weight', 'artcore' ),
        'section'  => 'ptf_heading_font_options',
        'default'  => 700,
        'priority' => 10,
        'choices'  => array(
            'min'  => 100,
            'max'  => 900,
            'step' => 100,
        ),
        'output' => array(
            'element'  => 'h1,h2,h3,h4,h5,h6',
            'property' => 'font-weight',
        ),
    );
    
    return $fields;
}

add_filter( 'kirki/fields', 'ptf_typography_controls_fields' );

/**
 * Add Blog Controls
 */
function ptf_blog_controls_fields( $fields ) {
    
    // Blog Layout
    $fields[] = array(
        'type'        => 'radio',
        'settings'    => 'ptf_blog_layout',
        'label'       => __( 'Blog Layout', 'artcore' ),
        'description' => __( 'Choose your prefered blog layout below.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_blog_options',
        'default'     => 'classic-layout',
        'priority'    => 10,
        'choices'     => array(
            'classic-layout' => __( 'Classic', 'artcore' ),
            'masonry-layout' => __( 'Masonry', 'artcore' ),
        ),
    );
    
    // Show Blog Heading
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'ptf_show_blog_heading',
        'label'       => __( 'Blog Page Heading', 'artcore' ),
        'description' => __( 'Check this option to show/hide the blog page title and subtitle.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_blog_options',
        'default'     => '1',
        'priority'    => 10,
    );
    
    // Blog Page Title
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_blog_page_title',
        'label'       => __( 'Blog Page Title', 'artcore' ),
        'description' => '',
        'help'        => '',
        'section'     => 'ptf_blog_options',
        'default'     => 'Blog',
        'priority'    => 10,
    );
    
    // Blog Page Subtitle
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_blog_page_subtitle',
        'label'       => __( 'Blog Page Subtitle', 'artcore' ),
        'description' => '',
        'help'        => '',
        'section'     => 'ptf_blog_options',
        'default'     => 'Check our latest news',
        'priority'    => 10,
    );
      
    // Blog Excerpt
    $fields[] = array(
        'type'        => 'number',
        'settings'    => 'ptf_blog_excerpt',
        'label'       => __( 'Blog Excerpt', 'artcore' ),
        'description' => __( 'Define the character count for blog excerpts.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_blog_options',
        'default'     => '65',
        'priority'    => 10,
    );
     
    return $fields;
}

add_filter( 'kirki/fields', 'ptf_blog_controls_fields' );

/**
 * Add Projects Controls
 */
function ptf_projects_controls_fields( $fields ) {
    
    // Projects Per Page
    $fields[] = array(
        'type'        => 'number',
        'settings'    => 'ptf_projects_per_page',
        'label'       => __( 'Projects Per Page', 'artcore' ),
        'description' => __( 'Enter the number of projects per page.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_projects_options',
        'default'     => '6',
        'priority'    => 10,
    );
    
    // Previous Project Button Label
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_previous_button_label',
        'label'       => __( 'Previous Project Button Label', 'artcore' ),
        'description' => __( 'Enter the button label for previous project.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_projects_options',
        'default'     => 'Prev Project',
        'priority'    => 10,
    );
    
    // Previous Project Button Label
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_next_button_label',
        'label'       => __( 'Next Project Button Label', 'artcore' ),
        'description' => __( 'Enter the button label for next project.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_projects_options',
        'default'     => 'Next Project',
        'priority'    => 10,
    );
     
    return $fields;
}

add_filter( 'kirki/fields', 'ptf_projects_controls_fields' );

/**
 * Add Social Networks Controls
 */
function ptf_social_controls_fields( $fields ) {
    
    // Show RSS Icon?
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'ptf_show_rss_icon',
        'label'       => __( 'Show RSS Icon', 'artcore' ),
        'description' => __( 'Check this option to show/hide the rss icon.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_social_options',
        'default'     => '1',
        'priority'    => 10,
    );
    
    // Facebook URL
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_facebook_url',
        'label'       => __( 'Facebook', 'artcore' ),
        'description' => __( 'Enter your facebook url below.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_social_options',
        'default'     => '#',
        'priority'    => 10,
    );
    
    // Twitter URL
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_twitter_url',
        'label'       => __( 'Twitter', 'artcore' ),
        'description' => __( 'Enter your twitter url below.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_social_options',
        'default'     => '#',
        'priority'    => 10,
    );
    
    // Linkedin URL
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_linkedin_url',
        'label'       => __( 'LinkedIn', 'artcore' ),
        'description' => __( 'Enter your linkedin url below.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_social_options',
        'default'     => '#',
        'priority'    => 10,
    );
    
    // Flickr URL
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_flickr_url',
        'label'       => __( 'Flickr', 'artcore' ),
        'description' => __( 'Enter your flickr url below.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_social_options',
        'default'     => '#',
        'priority'    => 10,
    );
    
    // Youtube URL
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_youtube_url',
        'label'       => __( 'Youtube', 'artcore' ),
        'description' => __( 'Enter your youtube url below.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_social_options',
        'default'     => '#',
        'priority'    => 10,
    );
    
    // Instagram URL
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_instagram_url',
        'label'       => __( 'Instagram', 'artcore' ),
        'description' => __( 'Enter your instagram url below.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_social_options',
        'default'     => '#',
        'priority'    => 10,
    );
    
    // Google+ URL
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_googleplus_url',
        'label'       => __( 'Google+', 'artcore' ),
        'description' => __( 'Enter your google+ url below.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_social_options',
        'default'     => '#',
        'priority'    => 10,
    );
    
    // Tumblr URL
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_tumblr_url',
        'label'       => __( 'Tumblr', 'artcore' ),
        'description' => __( 'Enter your tumblr url below.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_social_options',
        'default'     => '#',
        'priority'    => 10,
    );
    
    // Custom Social Icon
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_custom_social_icon_url',
        'label'       => __( 'Custom Social Icon', 'artcore' ),
        'description' => __( 'Enter your custom social icon url below.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_social_options',
        'default'     => '#',
        'priority'    => 10,
    );
    
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'ptf_custom_social_font_icon',
        'label'       => '',
        'description' => __( 'Enter your custom social icon class (e.g fa fa-facebook).', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_social_options',
        'default'     => 'fa fa-share-square-o',
        'priority'    => 10,
    );
    

    return $fields;
}

add_filter( 'kirki/fields', 'ptf_social_controls_fields' );

/**
 * Add Code Integration Controls
 */
function ptf_code_integration_controls_fields( $fields ) {
    
    // Custom CSS
    $fields[] = array(
        'type'        => 'textarea',
        'settings'    => 'ptf_custom_css',
        'label'       => __( 'Custom CSS', 'artcore' ),
        'description' => __( 'Enter your custom css code below.', 'artcore' ),
        'help'        => '',
        'section'     => 'ptf_custom_code_options',
        'default'     => '',
        'priority'    => 10,
    );
    
    return $fields;
}

add_filter( 'kirki/fields', 'ptf_code_integration_controls_fields' );

/**
 * Configuration file for theme customizer.
 */
function ptf_customizer_config() {

    $args = array(
        'url_path' => get_template_directory_uri() . '/framework/includes/kirki/',
    );

    return $args;
}

add_filter( 'kirki/config', 'ptf_customizer_config' );