<?php
#-----------------------------------------------------------------#
# General Metaboxes Definitions
#-----------------------------------------------------------------#
 
add_filter( 'rwmb_meta_boxes', 'ptf_register_meta_boxes' );

function ptf_register_meta_boxes( $meta_boxes )
{
    $prefix = 'ptf_';
    
    $meta_boxes[] = array(
        'id' => 'ptf_page_options',
        'title' => __('Page Options', 'artcore'),
        'pages' => array( 'page' ),
        'context' => 'normal',
        'fields' => array(
            array(
                'name'      => __('Show Page heading?', 'artcore'),
                'desc'      => __('Check this option to show title and subtitle for the page.', 'artcore'),
                'id'        => $prefix . 'page_heading',
                'type'      => 'checkbox',
                'std'       => true
            ),
            array(
                'name'      => __('Page Subtitle', 'artcore'),
                'desc'      => __('Please input the subtitle for the page. <strong>Leave it blank to hide pages subtitles.</strong>', 'artcore'),
                'id'        => $prefix . 'page_subtitle',
                'type'      => 'text',
                'size'      => 60,
                'std'       => ''
            ),
            array(
                'name'      => __('Slider Shortcode', 'artcore'),
                'desc'      => __('Paste here the shortcode for your slider. <strong>Leave it blank to hide the slider.</strong><br><em>NOTE: Use this setting only for pages using the <strong>Blank Page</strong> template.</em> ', 'artcore'),
                'id'        => $prefix . 'page_slider_shortcode',
                'type'      => 'text',
                'size'      => 60,
                'std'       => ''
            ) 
        )
    );
    
    return $meta_boxes;
}