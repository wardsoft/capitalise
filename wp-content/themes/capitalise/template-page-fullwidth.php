<?php
/**Template name: Page Full Width
 * Page Full Width Template.
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

get_header(); ?>

<?php
    $show_page_heading = rwmb_meta('ptf_page_heading');
    // Prints page title according context
    if ( $show_page_heading ) {
        ptf_print_page_title();
    }  
?>  

<section>
    <div class="container">
        <div class="row">
            <div <?php post_class('col-md-12 page-content'); ?>>
                <?php
                    
                    while ( have_posts() ) : the_post();
                    
                        the_content();
                    
                        wp_link_pages(array('before' => __( 'Pages: ', 'artcore' ), 'next_or_number' => 'number'));
                        
                    endwhile; 
                        
                    // Check if we have post comments and show the comments template
                    if ( comments_open() || get_comments_number() ) {                       
                        comments_template();                        
                    }                     
                ?>
                
                <div class="spacer"></div>
            </div> <!-- /.page-content -->
        </div>
    </div>
</section>
<?php get_footer(); ?>