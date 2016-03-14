<?php

#-----------------------------------------------------------------#
# Print a Page Title According Context (Pages, Categories, Authors)
#-----------------------------------------------------------------#

if ( ! function_exists( 'ptf_print_page_title' ) ) {
        
    function ptf_print_page_title() {
        
       $page_title = null;
       $page_subtitle = null;
       
       // Print title for blog pages       
       if ( is_home() ) {
           
           $page_title = get_theme_mod( 'ptf_blog_page_title', '');
           $page_subtitle = get_theme_mod( 'ptf_blog_page_subtitle', '');
           
       }
       // Print title for regular pages     
       elseif ( is_page() ) {
            $page_title = get_the_title();
            $page_subtitle = rwmb_meta('ptf_page_subtitle');
       }
       
       // Print title for category pages 
       elseif ( is_category() ) {
            $page_title = single_cat_title('', false);
            $page_subtitle = null;
       }
       
       // Print title for 404 pages
       elseif ( is_404() ) {
            $page_title = __('404', 'artcore' );
            $page_subtitle = __('Page Not Found', 'artcore' );
       }
       
       // Print title for search pages
       elseif ( is_search() ) {
            $page_title = __('Search Results ', 'artcore');
            $page_subtitle = __('Search results for: ' . get_search_query( false ), 'artcore' );
       }
       
       // Print title for author pages
       elseif ( is_author() ) {
             $page_title = get_the_author();
             $page_subtitle = __('All the posts by '.$page_title, 'artcore');
       }
       
       // Print Title for single post pages
       elseif ( is_single() ) {
             $page_title = null;
             $page_subtitle = null;
       }
       
       // Print Title for archive pages        
       elseif ( is_date() ) {
           
            if ( is_day() ) {
                 $page_title = get_the_date();
                 $page_subtitle = __('All the posts of '.$page_title, 'artcore');
            }
            
            elseif ( is_month() ) {
                 $page_title = get_the_date('F Y');
                 $page_subtitle = __('All the posts of '.$page_title, 'artcore');
            }
            
            elseif ( is_year() ) {
                 $page_title = get_the_date('Y');
                 $page_subtitle = __('All the posts of '.$page_title, 'artcore');
            }
       }
       
       ?> 
       
       <?php if ( ! empty( $page_title ) || !empty( $page_subtitle )) : ?>
            
           <section class="section-header">
                <div class="container">
                    <div class="row">
                       <div class="col-sm-12 text-center">
                           <h3><?php echo esc_html( $page_title ); ?></h3>                
                           <?php           
                                if ( !empty( $page_subtitle )) : ?>
                                                            
                                    <p><?php echo esc_html( $page_subtitle ); ?></p>
                                                                    
                          <?php endif; ?>                
                       </div>  
                    </div> 
                </div>     
            </section>
            
       <?php endif; ?>
       
    <?php
    }
}

#-----------------------------------------------------------------#
# Display Paging Navigation
#-----------------------------------------------------------------#

if ( ! function_exists( 'ptf_paging_nav' ) ) {
  
    function ptf_paging_nav() {

        // Don't print empty markup if there's only one page.
        if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
            return;
        }
    
        $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args   = array();
        $url_parts    = explode( '?', $pagenum_link );
    
        if ( isset( $url_parts[1] ) ) {
            wp_parse_str( $url_parts[1], $query_args );
        }
    
        $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
    
        $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
    
        // Set up paginated links.
        $links = paginate_links( array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $GLOBALS['wp_query']->max_num_pages,
            'current'  => $paged,
            'mid_size' => 1,
            'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => '<i class="fa fa-angle-left"></i>',
            'next_text' => '<i class="fa fa-angle-right"></i>',
        ) );
    
        if ( $links ) :
        ?>
        
        <nav class="container page-navigation">
            <div class="spacer-30 clearfix"></div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <?php echo wp_kses_post( $links ); ?>
                </div>
            </div>
        </nav>
        
        <?php
        endif;
    }  
          
}

#-----------------------------------------------------------------#
# Display Previous/Next Links
#-----------------------------------------------------------------#

if ( ! function_exists( 'ptf_blog_posts_nav' ) ) {
    
    function ptf_blog_posts_nav() {
      
      if( get_next_posts_link() || get_previous_posts_link() ) : ?>

          <div class="row">
              <div class="col-sm-12">
                  <div class="nav-links clearfix">
                      <div class="nav-previous">
                        <?php previous_posts_link( __( 'Newer Posts', 'artcore' ) ) ?>
                      </div>
                      <div class="nav-next">
                        <?php next_posts_link( __( 'Older Posts', 'artcore' ) ,'' ) ?>
                     </div>
                 </div>
             </div>
         </div>
            
     <?php endif;   
        
    }
    
    
}

if ( ! function_exists( 'ptf_single_post_nav' ) ) {

    function ptf_single_post_nav() {

        $prev_post = get_adjacent_post( false, '', true );
        $next_post = get_adjacent_post( false, '', false );
        
        $prev_post_label = get_theme_mod( 'ptf_previous_button_label' );
        $next_post_label = get_theme_mod( 'ptf_next_button_label' );
        
        // Dont print markup if we don't have posts
        if ( ! $prev_post && ! $next_post )
            return;
        ?>
        
        <?php if ( is_singular( 'project') ) : ?>
         
        <div class="row">
            <div class="col-sm-12">
                <div class="project-nav hidden-xs">
                    
                    <?php if( !empty( $next_post ) ) : ?>
                    <div class="project-prev">                       
                        <?php echo '<a class="btn btn-default" href="' . esc_url( get_permalink( $next_post->ID ) ) . '" title="' . esc_attr( $next_post->post_title ) . '">' . '<i class="fa fa-angle-left"></i>' . esc_html( $prev_post_label ) . '</a>'; ?>
                    </div>
                    <?php endif; ?>
                                                           
                    <?php if( !empty( $prev_post ) ) : ?>
                    <div class="project-next">                                               
                        <?php echo '<a class="btn btn-default" href="' . esc_url( get_permalink( $prev_post->ID ) ) . '" title="' . esc_attr( $prev_post->post_title ) . '">' . esc_html( $next_post_label ) . '<i class="fa fa-angle-right"></i>' . '</a>'; ?>
                    </div>
                    <?php endif; ?>
                    
                </div>              
            </div>
        </div>
        
        <?php endif; ?>
        
        <?php if ( is_singular( 'post' ) ) : ?>
            
            <div class="row">
                    <div class="col-sm-12">
                        <hr>                        
                        <div class="nav-links clearfix">
                            
                            <?php if( ! empty( $next_post ) ) : ?>
                            <div class="nav-previous">                               
                                 <?php echo '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '" title="' . esc_attr( $next_post->post_title ) . '">' . esc_html( $next_post->post_title ) . '</a>'; ?>
                            </div>
                            <?php endif; ?>
                            
                            <?php if( ! empty( $prev_post ) ) : ?>
                            <div class="nav-next">                                
                                <?php echo '<a href="' . esc_url( get_permalink( $prev_post->ID ) ) . '" title="' . esc_attr( $prev_post->post_title ) . '">' . esc_html( $prev_post->post_title ) . '</a>'; ?>
                            </div>
                            <?php endif; ?>
                            
                        </div>
                        <hr>
                    </div>
                </div>
                
        <?php endif; ?>
        
        <?php
    }
}

#-----------------------------------------------------------------#
# Excerpt Related & Utilities Functions
#-----------------------------------------------------------------#

function ptf_new_excerpt_length( $more ) {
    
    $new_excerpt_lenght = get_theme_mod( 'ptf_blog_excerpt', '100' );
    return (int)$new_excerpt_lenght;
    
}

add_filter( 'excerpt_length', 'ptf_new_excerpt_length');

if ( ! function_exists( 'ptf_excerpt_more' )) {
    function ptf_excerpt_more( $more ) {      
        return '.';        
    }
}

add_filter( 'excerpt_more', 'ptf_excerpt_more' );

#-----------------------------------------------------------------#
# Flush the WordPress Rewrite Rules
#-----------------------------------------------------------------#

function ptf_rewrite_flush() {
    
    flush_rewrite_rules();
    
}

add_action('after_switch_theme', 'ptf_rewrite_flush');

#-----------------------------------------------------------------#
# Enables Schema.org for Better SEO
#-----------------------------------------------------------------#

if ( ! function_exists( 'ptf_html_tag_schema' ) ) {
    
    function ptf_html_tag_schema() {
        $schema = 'http://schema.org/';
    
        // Is single post
        if(is_single()) {
            $type = "Article";
        }
        else if(is_home() || is_category()) {
            $type = 'Blog';
        }
        // Is author page
        elseif( is_author() ) {
            $type = 'ProfilePage';
        }
        // Is search results page
        elseif( is_search() ) {
            $type = 'SearchResultsPage';
        }
        else {
            $type = 'WebPage';
        }
    
        echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema . $type ) . '"';
    }
}

#-----------------------------------------------------------------#
# Print Custom Color Options from the Customizer
#-----------------------------------------------------------------#

function ptf_print_custom_color_css() {
    
     // Get the values from the customizer settings
     $ptf_custom_accent_color = get_theme_mod( 'ptf_accent_color', '#e6772e' );
     $ptf_custom_accent_hover_color = get_theme_mod( 'ptf_accent_hover_color', '#eb955c');
     
     // Prepare initial markup for inline custom css
     $output = '<style type="text/css">';
     
     // Print color values
     $output .= '
        .post table td a,
        .page table td a,
         a,
         .widget_calendar #wp-calendar td a,
         .blog-classic .blog-post .post-header .post-title a:hover,
         .blog-isotope .blog-post .blog-title:hover .blog-title-inner,
         .team-item .team-thumb .hover a:hover,
         #sidebar .widget a:hover,
         #projects-filter a:hover,
         .service-icon,
         nav.main-navigation ul a:hover, 
         nav.main-navigation ul .current-menu-item a {
             color:' . $ptf_custom_accent_color .';
         }';
         
     $output .= '
        .sticky .post-title a {
            color:'.$ptf_custom_accent_color.'!important;
        }
     ';
     // Print color hover values    
     $output .= '
         .read-more:hover {
            color:' . $ptf_custom_accent_hover_color .'; 
         }'; 
     
     // Print background color values       
     $output .= '
         footer .footer-widgets .widget_mc4wp_widget form input[type="submit"],
         #sidebar .widget input[type="submit"],
         #sidebar .widget button,
         .blog-classic .blog-post .post-date,
         .progress-bar,
         .btn.btn-accent,
         .team-item .team-thumb .hover {
             background-color:' . $ptf_custom_accent_color .';
         }';
     
     $output .= '
        #sidebar .widget input[type="submit"],
        #sidebar .widget button {
            border-color:'. $ptf_custom_accent_color . ';
        }
     ';
     
     // Background accent for webkit browsers
     $output .= '
         ::selection {
            background:' . $ptf_custom_accent_color .';
        }
     ';
     
     // Background accent for mozila browsers
     $output .= '
         ::-moz-selection {
            background:' . $ptf_custom_accent_color .';
        }
     ';
     
     // Close the markup
     $output .= '</style>';
     
     // Print custom css with correct escaping
     echo wp_kses( $output, array( 'style' => array( 'type' => array() ) ) );
}

add_action('wp_head', 'ptf_print_custom_color_css');

#-----------------------------------------------------------------#
# Print Custom CSS Options from the Customizer
#-----------------------------------------------------------------#

function ptf_print_custom_css() {
    
    // Get the custom css from the customizer
     $ptf_custom_css = get_theme_mod( 'ptf_custom_css');
     
     // Prepare initial markup for inline custom css
     $output = '<style type="text/css">';
     
     $output .= $ptf_custom_css; 
     
     // Close the markup
     $output .= '</style>';
     
     if ( $ptf_custom_css != '' ) {        
        // Print custom css with correct escaping
        echo wp_kses( $output, array( 'style' => array( 'type' => array() ) ) );       
     }
     
}

add_action('wp_head', 'ptf_print_custom_css');