<?php
/**
 * Header Template File.
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

?><!DOCTYPE html>
<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->
<html <?php ptf_html_tag_schema(); ?> <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        
        <?php if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) ) : ?>
            
            <link rel="shortcut icon" href="<?php echo esc_url( get_theme_mod( 'ptf_favicon', get_template_directory_uri() . '/assets/images/icons/favicon.ico' ) ); ?>">
            <link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( get_theme_mod( 'ptf_touch_icon_72', get_template_directory_uri() . '/assets/images/icons/apple-touch-icon72.png' ) ); ?>">
            <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( get_theme_mod( 'ptf_touch_icon_144', get_template_directory_uri() . '/assets/images/icons/apple-touch-icon144.png' ) ); ?>">
            
        <?php endif; ?>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="sidebar-menu-container" id="sidebar-menu-container">
            <div class="sidebar-menu-push">
                <div class="sidebar-menu-overlay"></div>
                <div class="sidebar-menu-inner">
                    <header class="site-header">
                            <div class="top-header">
                                <div class="inner-header clearfix">
                                    <div class="left-header"><span style="color:#f89728;">Tel:</span> <span style="color:#ffffff; font-weight:bold;">020 7247 6943</span> <span style="padding-left:30px;color:#f89728;">E-mail:</span> <span style="color:#ffffff; font-weight:bold;">info@capitalise.com</span></div>
                                    <div class="right-header">
                                        <div class="social">
                                            
                                            <?php if ( get_theme_mod( 'ptf_facebook_url' ) != '' ) : ?>
                                                <a href="<?php echo esc_url( get_theme_mod( 'ptf_facebook_url' ) ); ?>"><i class="fa fa-facebook"></i></a>
                                            <?php endif; ?>
                                            
                                            <?php if ( get_theme_mod( 'ptf_twitter_url' ) != '' ) : ?>
                                                <a href="<?php echo esc_url( get_theme_mod( 'ptf_twitter_url' ) ); ?>"><i class="fa fa-twitter"></i></a>
                                            <?php endif; ?>
                                            
                                            <?php if ( get_theme_mod( 'ptf_linkedin_url' ) != '' ) : ?>
                                                <a href="<?php echo esc_url( get_theme_mod( 'ptf_linkedin_url' ) ); ?>"><i class="fa fa-linkedin"></i></a>
                                            <?php endif; ?>
                                            
                                            <?php if ( get_theme_mod( 'ptf_googleplus_url' ) != '' ) : ?>
                                                <a href="<?php echo esc_url( get_theme_mod( 'ptf_googleplus_url' ) ); ?>"><i class="fa fa-google-plus"></i></a>
                                            <?php endif; ?>
                                            
                                            <?php if ( get_theme_mod( 'ptf_flickr_url' ) != '' ) : ?>
                                                <a href="<?php echo esc_url( get_theme_mod( 'ptf_flickr_url' ) ); ?>"><i class="fa fa-flickr"></i></a>
                                            <?php endif; ?>
                                            
                                            <?php if ( get_theme_mod( 'ptf_youtube_url' ) != '' ) : ?>
                                                <a href="<?php echo esc_url( get_theme_mod( 'ptf_youtube_url' ) ); ?>"><i class="fa fa-youtube-play"></i></a>
                                            <?php endif; ?>
                                            
                                            <?php if ( get_theme_mod( 'ptf_instagram_url' ) != '' ) : ?>
                                                <a href="<?php echo esc_url( get_theme_mod( 'ptf_instagram_url' ) ); ?>"><i class="fa fa-instagram"></i></a>
                                            <?php endif; ?>
                                            
                                            <?php if ( get_theme_mod( 'ptf_tumblr_url' ) != '' ) : ?>
                                                <a href="<?php echo esc_url( get_theme_mod( 'ptf_tumblr_url' ) ); ?>"><i class="fa fa-tumblr-square"></i></a>
                                            <?php endif; ?>
                                            
                                            <?php if ( get_theme_mod( 'ptf_custom_social_icon_url' ) != '' ) : ?>
                                                <a href="<?php echo esc_url( get_theme_mod( 'ptf_custom_social_icon_url' ) ); ?>"><i class="<?php echo esc_attr( get_theme_mod( 'ptf_custom_social_font_icon' ) ); ?>"></i></a>
                                            <?php endif; ?>
                                            
                                             <?php if ( get_theme_mod( 'ptf_show_rss_icon') == '1' ) : ?>
                                                <a href="<?php echo bloginfo( 'rss2_url' ); ?>"><i class="fa fa-rss"></i></a>
                                            <?php endif; ?>
                                            	<a href="/partner-login" style="margin-left: 20px;"><i class="fa fa-sign-in" style="color:#e6772e"></i><span style="font-size:14px;color:#e6772e; font-weight: bold;padding: 5px 5px 5px 5px;height: 35px;display:inline-block;">Partner Login</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div id="main-header" class="main-header header-sticky">
                            <div class="inner-header clearfix">
                                <div class="logo">
                                    <a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>" rel="home">
                                        <img class="logo-holder" src="<?php echo esc_url( get_theme_mod( 'ptf_logo', get_template_directory_uri() . '/assets/images/logo.png' ) );?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
                                    </a>
                                </div>
                                <div class="header-right-toggle pull-right visible-sm visible-xs">
                                    <a href="javascript:void(0)" class="side-menu-button"><i class="fa fa-bars"></i></a>
                                </div>
                                
                                <?php 
                                    $show_header_search = get_theme_mod( 'ptf_show_hide_search_icon', '1' );
                                    if ( $show_header_search == '1' ) : ?>
                                        <div class="search-menu-button pull-right hidden-sm hidden-xs">
                                            <a href="javascript:void(0)" class="search-link"><i class="fa fa-search"></i></a>
                                            <div class="header-search-wrap">
                                                <form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                                    <input type="text" placeholder="<?php echo esc_attr__('Search here', 'artcore'); ?>" name="s" autocomplete="off">
                                                </form>
                                            </div>
                                        </div>
                                <?php endif; ?>
                                
                                <nav class="main-navigation pull-right hidden-xs hidden-sm">
                                    <?php
                                        if ( has_nav_menu( 'header_main_menu' ) ) :
                                            $header_menu = array(
                                                    'container' => false,
                                                    'menu_id' => '',
                                                    'depth' => 0,
                                                    'theme_location' => 'header_main_menu',                                                  
                                            );      
                                            wp_nav_menu( $header_menu );
                                        endif; 
                                    ?>
                                </nav>
                            </div>
                        </div>
                    </header>