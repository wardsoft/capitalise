<?php
/**
 * This file control all custom modules for Aqua Page Builder
 * 
 * @package PlugFramework
 * @package Artcore
 */

// Exit the Script if Aqua Page Builder is not Activated 
if( !class_exists( 'AQ_Page_Builder' ) ) {
    return;
}

// Define the Correct Path for Custom Blocks
if( !defined('PTF_LIB_BLOCK_DIR') ) define( 'PTF_LIB_BLOCK_DIR', PTF_FRAMEWORK_DIRECTORY . trailingslashit( '/includes/page-builder/blocks' ) );

// Unregister Default Blocks
aq_unregister_block('AQ_Clear_Block');
aq_unregister_block('AQ_Editor_Block');
aq_unregister_block('AQ_Tabs_Block');
aq_unregister_block('AQ_Text_Block');
aq_unregister_block('AQ_Upload_Block');
aq_unregister_block('AQ_Widgets_Block');
aq_unregister_block('AQ_Alert_Block');
aq_unregister_block('AQ_Column_Block');

// Include the Custom Block Files
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-section-start.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-section-end.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-heading-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-portfolio-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-service-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-skillbar-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-team-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-testimonials-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-blog-posts-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-cta-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-map-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-text-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-text-image-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-alert-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-widgets-block.php' );
require_once ( PTF_LIB_BLOCK_DIR . 'ptf-clear-block.php' );

// Custom Block Scripts and Styles
function ptf_page_builder_admin_css() {
    wp_enqueue_style('ptf-block-admin-css', PTF_FRAMEWORK_DIRECTORY_URI . '/framework/includes/page-builder/assets/stylesheets/block-admin-styles.css', array(), PTF_FRAMEWORK_THEME_VERSION );
    
}
// Hook in the Admin
add_action( 'admin_init', 'ptf_page_builder_admin_css' );

function ptf_page_builder_frontend_js() {
    wp_enqueue_script( 'ptf-block-frontend-js', PTF_FRAMEWORK_DIRECTORY_URI . '/framework/includes/page-builder/assets/javascripts/block-frontend-scripts.js', array('jquery'), PTF_FRAMEWORK_THEME_VERSION , true );
}
// Hook in Aqua Builder Blocks
add_action( 'aq-page-builder-view-enqueue', 'ptf_page_builder_frontend_js' );