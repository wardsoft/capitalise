<?php
/**
 * Default Single Template File.
 *
 * @package PlugFramework
 * @subpackage Artcore
 */
 
get_header(); ?>
<section class="latest-news">
	<div class="container">
		<div class="row">
			<div class="col-md-8 blog-classic">
				<?php				  
				    // Starts the loop
				    while ( have_posts() ) : the_post();
                    
                        get_template_part('framework/includes/partials/content', get_post_format() );
                        wp_link_pages( array(
                            'before'      => '<div class="page-links">',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'artcore') . ' </span>%',
                            'separator'   => '<span class="screen-reader-text"> </span>'
                        ) ); 
                    
                    // Ends the loop
                    endwhile;
                    
                   //Outputs tags list
                   if ( get_the_tag_list() ) : ?>
                       <div class="tags">
                           <?php echo get_the_tag_list('',' ',''); ?>
                       </div> <!-- /.tags -->
                   <?php endif;
                   
                    // Print regular pagination
				    ptf_single_post_nav(); 

				    // Check if we have post comments and show the comments template
                    if ( comments_open() || get_comments_number() ) {                       
                        comments_template();
                    }  
                ?>				
				<div class="spacer"></div>
			</div> <!-- /.blog-classic -->			
			<?php get_sidebar(); ?>			
		</div>
	</div>
</section>
<?php get_footer(); ?>