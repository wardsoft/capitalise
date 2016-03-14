<?php
/**
 * Main Template File.
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

get_header(); ?>

<?php
    // Get the layout options from the theme customizer
    $blog_layout = get_theme_mod( 'ptf_blog_layout', 'classic-layout' );
    $blog_layout_wrapper_start = null;
    $blog_layout_wrapper_end = null;
    $show_blog_heading = get_theme_mod( 'ptf_show_blog_heading', '1');
    
    if ( $blog_layout == 'classic-layout' ) {
        $blog_layout_wrapper_start = '<div class="col-md-8 blog-classic">';
        $blog_layout_wrapper_end = '</div>';        
    }
    
    if ( $blog_layout == 'masonry-layout') {
         $blog_layout_wrapper_start = '<div class="blog-isotope">';
         $blog_layout_wrapper_end = '</div>';
    }
?>

<?php 
    if ( $show_blog_heading == '1' ) {        
        ptf_print_page_title();  
    } 
?>

<section class="latest-news">
    <div class="container">        
        <div class="row">
                       
            <?php echo wp_kses_post( $blog_layout_wrapper_start ); ?>
            
            <?php
            
                if ( have_posts() ) :  while ( have_posts() ) : the_post();
                                    
                        get_template_part( 'framework/includes/partials/content', get_post_format() );
         
                endwhile; else :
                    
                        get_template_part( 'framework/includes/partials/content-none' );
                    
                endif; 
                
                ?>
                 
                <?php if ( $blog_layout != 'masonry-layout' ) : ?>
                                    
                    <?php ptf_blog_posts_nav(); ?>                   
                    <div class="spacer"></div>
                                        
                <?php endif; ?>

                
            <?php echo wp_kses_post( $blog_layout_wrapper_end ); ?>
            
            <?php if ( $blog_layout == 'masonry-layout' ) : ?>
                                
                <div class="row page-navigation">
                        <div class="col-sm-12 text-center">
                                <?php the_posts_pagination( array(
                                    'mid_size' => 1,
                                    'prev_text' => '<i class="fa fa-angle-left"></i>',
                                    'next_text' => '<i class="fa fa-angle-right"></i>',
                                     'screen_reader_text' => ' ',
                
                                )); ?>
                            </a>
                        </div>
                    </div>
                                       
                <?php endif; ?>
                      
            <?php if ( $blog_layout != 'masonry-layout' ) get_sidebar(); ?>
            
        </div>
    </div>
</section>
<?php get_footer(); ?>