<?php
/**
 * File for registering custom post types.
 *
 * @package    Artcore Addons
 * @subpackage Includes
 * @author     Esmeth Team
 * 
 */

 if ( !defined( 'ABSPATH' ) ) 
    die( '-1' );
 
 if( !class_exists( 'Artcore_Portfolio' ) ) {
     
    class Artcore_Portfolio {
        
        public static $instance;
    
        // Setup a single instance using the singleton pattern
        public static function init() {
                 
            if ( is_null( self::$instance ) ) {
                self::$instance = new Artcore_Portfolio();
            }         
            return self::$instance;
            
        }
        
        function __construct() {
            
            add_action( 'init', array($this, 'register_taxonomies' ), 5 );
            add_action( 'init', array($this, 'register_post_types' ), 6 );
            add_filter( 'rwmb_meta_boxes', array($this,'register_meta_boxes' ));
            
            if( is_admin() ) {
                
                add_filter( 'manage_edit-project_columns' , array( $this,'add_project_columns' ) );
                add_action( 'manage_project_posts_custom_column' , array( $this,'set_project_columns_content' ), 10, 2 );
                
            }
        }
        
        function register_post_types() {
            
            if ( post_type_exists('project') ) {
                return;
            }
            
            $labels = array(
                'name'                => _x( 'Projects', 'Post Type General Name', 'artcore-addons' ),
                'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'artcore-addons' ),
                'menu_name'           => __( 'Projects', 'artcore-addons' ),
                'parent_item_colon'   => __( 'Parent Project:', 'artcore-addons' ),
                'all_items'           => __( 'All Projects', 'artcore-addons' ),
                'view_item'           => __( 'View Project', 'artcore-addons' ),
                'add_new_item'        => __( 'Add New Project', 'artcore-addons' ),
                'add_new'             => __( 'Add New Project', 'artcore-addons' ),
                'edit_item'           => __( 'Edit Project', 'artcore-addons' ),
                'update_item'         => __( 'Update Project', 'artcore-addons' ),
                'search_items'        => __( 'Search Project', 'artcore-addons' ),
                'not_found'           => __( 'Not found', 'artcore-addons' ),
                'not_found_in_trash'  => __( 'Not found in Trash', 'artcore-addons' ),
            );
            
            $rewrite = array(
                'slug'                => __('project', 'artcore-addons' ),
                'with_front'          => false,
            );
            
            $args = array(
                'label'               => __( 'project', 'artcore-addons' ),
                'description'         => __( 'Project Post Type', 'artcore-addons' ),
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'thumbnail', ),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => false,
                'show_in_admin_bar'   => true,
                'menu_position'       => 20,
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'query_var'           => 'project',
                'rewrite'             => $rewrite,
                'menu_icon'           => 'dashicons-screenoptions',
                'capability_type'     => 'post',
            );
        
            register_post_type( 'project', $args );
            
        }
        
        function register_taxonomies() {
            
             if ( taxonomy_exists( 'project-categories') ) {
                return;
            }
            
            $project_labels = array(
                'name' => __( 'Project Categories', 'artcore-addons'),
                'singular_name' => __( 'Project Category', 'artcore-addons'),
                'search_items' =>  __( 'Search Project Categories', 'artcore-addons'),
                'all_items' => __( 'All Project Categories', 'artcore-addons'),
                'parent_item' => __( 'Parent Project Category', 'artcore-addons'),
                'edit_item' => __( 'Edit Project Category', 'artcore-addons'),
                'update_item' => __( 'Update Project Category', 'artcore-addons'),
                'add_new_item' => __( 'Add New Project Category', 'artcore-addons'),
                'menu_name' => __( 'Project Categories', 'artcore-addons')
            );  

            register_taxonomy( 'project-categories', 
                array( 'project' ), 
                array( 'hierarchical' => true, 
                    'labels' => $project_labels,
                    'show_ui' => true,
                    'query_var' => true,
                    'rewrite' => array( 'slug' => __('project-category', 'artcore-addons'))
            ));
            
        }
        
        function register_meta_boxes( $meta_boxes ) {
            
            $prefix = 'ptf_';
    
            $meta_boxes[] = array(
                'id' => 'ptf_project_options',
                'title' => __('Project Options', 'artcore-addons'),
                'pages' => array('project'),
                'context' => 'normal',
                'fields' => array(
                    // IMAGE ADVANCED (WP 3.5+)
                    array(
                        'name'             => __( 'Project Gallery', 'artcore-addons'),
                        'desc'             => __('Upload the images to be used in the project gallery. <strong>Maximum of 3 images allowed.</strong>', 'artcore-addons'),
                        'id'               => $prefix . 'project_gallery',
                        'type'             => 'image_advanced',
                        'max_file_uploads' => 3,
                    ),
                    array(
                        'name'      => __('Client', 'artcore-addons'),
                        'desc'      => __('Enter the client name <em>(e.g Samuel I. Lawson)</em>. <strong>Leave it blank to hide this info.</strong>', 'artcore-addons'),
                        'id'        => $prefix . 'project_client',
                        'type'      => 'text',
                        'size'      => 60,
                        'std'       => ''
                    ),
                    array(
                        'name'      => __('Project Date', 'artcore-addons'),
                        'desc'      => __('Enter the project date <em>(e.g 22 July 2015)</em>. <strong>Leave it blank to hide this info.</strong>', 'artcore-addons'),
                        'id'        => $prefix . 'project_date',
                        'type'      => 'text',
                        'size'      => 60,
                        'std'       => ''
                    ),
                    array(
                        'name'      => __('Project Location', 'artcore-addons'),
                        'desc'      => __('Enter the location for the project <em>(e.g Hazelwood Algona, 4067)</em>. <strong>Leave it blank to hide this info.</strong>', 'artcore-addons'),
                        'id'        => $prefix . 'project_location',
                        'type'      => 'text',
                        'size'      => 60,
                        'std'       => ''
                    ),           
                    array(
                        'name'      => __('Show Social Sharing Buttons?', 'artcore-addons'),
                        'desc'      => __('Check this option if you want to show the social sharing buttons for the project.', 'artcore-addons'),
                        'id'        => $prefix . 'project_share',
                        'type'      => 'checkbox',
                        'std'       => true
                    )
                    
                )
            );
            
            return $meta_boxes;
            
        }
        
        function add_project_columns( $cols ) {
            
             $cols = array(
                'cb'        =>   '<input type="checkbox" />',
                'title'     => __( 'Title', 'artcore-addons' ),
                'client'    => __( 'Client', 'artcore-addons' ),
                'category'  => __( 'Category', 'artcore-addons'),
                'thumbnail' => __( 'Thumbnail', 'artcore-addons')  
            );
        
            return $cols;
            
        }
        
        function set_project_columns_content( $column, $post_id ) {
            
            $width = (int) 35;
            $height = (int) 35;
        
            switch( $column ) {
               
               case 'client' :
                   echo wp_kses_post( get_post_meta( $post_id, 'ptf_project_client', true ) );
                   break;
                   
               case 'category' :
                   echo wp_kses_post( get_the_term_list( $post_id,'project-categories','',', ','' ) );
                   break;
                   
               case 'thumbnail' :
                   $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
                   $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
                   
                   if ( $thumbnail_id ) {
                       
                       $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
                       
                   } elseif ( $attachments ) {
                       
                        foreach ( $attachments as $attachment_id => $attachment ) {
                            
                            $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
                            
                        }
                        
                   }
                   
                   if ( isset( $thumb ) && $thumb ) {                  
                            echo wp_kses_post( $thumb );
                   } else {                   
                            echo __('None', 'artcore-addons');
                  }
                   
                break;
                
           }
            
        }

    }
   
   // Always calls a single instance of the Artcore Portfolio Class. 
   Artcore_Portfolio::init();
 }
    
?>