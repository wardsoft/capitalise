<?php

/* *---------------------------------------------------------------------------
 * PlugFramework -  Functions and Definitions
 * ----------------------------------------------------------------------------
 * Contents:
 * 00 - Global Variables
 * 01 - Theme Constants
 * 02 - Basic Definitions
 * 03 - Includes
 * 
 */

/* ------------------------------------------------------------------------ */
/* 01 - Global Variables
/* ------------------------------------------------------------------------ */

// Some important theme infos is stored in the variable
$ptf_theme = wp_get_theme(); 

/* ------------------------------------------------------------------------ */
/* 01 - Theme Constants
/* ------------------------------------------------------------------------ */

define( 'PTF_FRAMEWORK_DIRECTORY', get_template_directory() . '/framework' );
define( 'PTF_FRAMEWORK_DIRECTORY_URI', get_template_directory_uri() );
define( 'PTF_FRAMEWORK_THEME_VERSION', $ptf_theme->Version );
define( 'TESTENVIRONMENT', FALSE );
  
/* -------------------------------------------------------------------------- */
/* 02 - Basic Definitions
/* -------------------------------------------------------------------------- */

// PlugFramework Themes only works in WordPress 4.1 or later.
if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) {
    require ( PTF_FRAMEWORK_DIRECTORY . '/includes/back-compat.php' );
}

// Set the content width based on the theme's design and stylesheet.
if ( !isset($content_width ) ) {
    $content_width = 1170;
}

/* ------------------------------------------------------------------------ */
/* 03 - Includes
  /* ------------------------------------------------------------------------ */

// Include Kirki Library and Configuration File for Theme Customizer
if ( !class_exists( 'Kirki' ) ) {
    include_once( PTF_FRAMEWORK_DIRECTORY. '/includes/kirki/kirki.php' );
}
include_once( PTF_FRAMEWORK_DIRECTORY . '/includes/theme-customizer.php' ); 

// Include Custom Metaboxes Script
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/framework/includes/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/framework/includes/meta-box' ) );
require_once( RWMB_DIR . 'meta-box.php' );
include 'framework/includes/meta-boxes.php';

// Theme Custom Blocks for Page Builder
require_once( PTF_FRAMEWORK_DIRECTORY . '/includes/page-builder/page-builder-init.php' );

// Theme External Libs and Helper Files
require_once( PTF_FRAMEWORK_DIRECTORY . '/includes/aq_resizer.php' );

// Theme Initial Setup (Register and Enqueue Styles and Scripts, Setup Menus, Widgets and Custom Post Types)
require_once( PTF_FRAMEWORK_DIRECTORY . '/includes/theme-init.php' );

// Theme Functions and Utilities
require_once( PTF_FRAMEWORK_DIRECTORY . '/includes/theme-functions.php' );

// Theme Widgets
require_once( PTF_FRAMEWORK_DIRECTORY . '/includes/widgets/ptf-recent-posts-widget.php' );
require_once( PTF_FRAMEWORK_DIRECTORY . '/includes/widgets/ptf-recent-projects-widget.php' );
require_once( PTF_FRAMEWORK_DIRECTORY . '/includes/widgets/ptf-flickr-widget.php' );

// Automatic Plugin Activation
require_once ( PTF_FRAMEWORK_DIRECTORY . '/includes/class-tgm-plugin-activation.php' );
require_once ( PTF_FRAMEWORK_DIRECTORY . '/includes/register-plugins.php' );