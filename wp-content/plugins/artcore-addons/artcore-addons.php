<?php
/**
 *
 *  Plugin Name: Artcore Addons
 *  Plugin URI: http://esmeth.com
 *  Description: The Artcore Theme Addons
 *  Version: 1.0
 *  Author: Esmeth Team
 *  Author URI: http://esmeth.com
 *
 *  Text Domain: artcore-addons
 *  Domain Path: /languages/
 *
 *  @package PlugFramework
 *  @category Core
 *  @author Esmeth Team
 *
 **/
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$current_theme = get_template();

if ( ( $current_theme == 'artcore' ) && !class_exists( 'Artcore_Addons' ) ) {
    
    class Artcore_Addons {

    /**
     * PHP5 constructor method.
     *
     * @since  0.1.0
     * @access public
     * @return void
     */
    public function __construct() {

        /* Set the constants needed by the plugin. */
        add_action( 'plugins_loaded', array( $this, 'constants' ), 1 );

        /* Internationalize the text strings used. */
        add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );

        /* Load the functions files. */
        add_action( 'plugins_loaded', array( $this, 'includes' ), 3 );
        
    }

    /**
     * Defines constants used by the plugin.
     *
     * @since  0.1.0
     * @access public
     * @return void
     */
    public function constants() {

        /* Set constant path to the plugin directory. */
        define( 'PTF_ADDONS_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

        /* Set the constant path to the plugin directory URI. */
        define( 'PTF_ADDONS_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

        /* Set the constant path to the includes directory. */
        define( 'PTF_ADDONS_INCLUDES', PTF_ADDONS_DIR . trailingslashit( 'includes' ) );
        
    }

    /**
     * Loads the initial files needed by the plugin.
     *
     * @since  0.1.0
     * @access public
     * @return void
     */
    public function includes() {
        
        /* Load the project custom post type. */
        require_once( PTF_ADDONS_INCLUDES . 'cpt-projects/post-types.php' );
    }

    /**
     * Loads the translation files.
     *
     * @since  0.1.0
     * @access public
     * @return void
     */
    public function i18n() {

        /* Load the translation of the plugin. */
        load_plugin_textdomain( 'artcore-addons', false, basename( dirname( __FILE__ ) ) . '/languages/' );
    }

}

new Artcore_Addons();
}