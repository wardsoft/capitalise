<?php

/**
 * PlugFramework back compat functionality
 *
 * Prevents PlugFramework from running on WordPress versions prior to 4.1,
 * since this theme is not meant to be backward compatible beyond that
 * and relies on many newer functions and markup changes introduced in 4.1.
 *
 */
function ptf_switch_theme() {
    switch_theme(WP_DEFAULT_THEME, WP_DEFAULT_THEME);
    unset($_GET['activated']);
    add_action('admin_notices', 'ptf_upgrade_notice');
}

add_action('after_switch_theme', 'ptf_switch_theme');

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Twenty Fourteen on WordPress versions prior to 4.1.
 */
function ptf_upgrade_notice() {
    $message = sprintf(__('PlugFramework requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'artcore'), $GLOBALS['wp_version']);
    printf('<div class="error"><p>%s</p></div>', $message);
}

function ptf_customize() {
    wp_die(sprintf(__('PlugFramework requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'artcore'), $GLOBALS['wp_version']), '', array(
        'back_link' => true,
    ));
}

add_action('load-customize.php', 'ptf_customize');

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.1.
 */
function ptf_preview() {
    if (isset($_GET['preview'])) {
        wp_die(sprintf(__('PlugFramework requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'artcore'), $GLOBALS['wp_version']));
    }
}

add_action('template_redirect', 'ptf_preview');