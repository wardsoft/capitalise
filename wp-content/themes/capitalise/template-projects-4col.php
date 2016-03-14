<?php
/**Template name: Projects Four Columns
 * Projects Four Columns Template File.
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

get_header(); ?>

<?php

    $show_page_heading = rwmb_meta('ptf_page_heading');
    $heading_add_pad = '';
    
    if ( $show_page_heading ) {
        // Print page title according context 
        ptf_print_page_title();
        
        $heading_add_pad = 'padding-top: 0';
    } else {
         $heading_add_pad = 'padding-top: 30px';
    }

?>

<div class="projects">
    <div class="container">
        
        <div class="row">            
            <div class="col-sm-12 text-center">
                <ul id="projects-filter" style="<?php echo esc_attr( $heading_add_pad ); ?>">
                    <li><a href="#" data-filter="*" class="active"><?php _e('Show All', 'artcore'); ?></a></li>                  
                    <?php
                        // Get all the project categories
                        $category_args = array( 'taxonomy' => 'project-categories' );
                        $filter_categories = get_categories( $category_args );
                        
                        // Print these categories with proper markup
                        foreach ( $filter_categories as $filter_category ) {
                            
                            echo '<li><a href="#" data-filter=".' . esc_attr( $filter_category -> slug ) . '">' . esc_html( $filter_category -> name ) . '</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
        
        <div class="row" id="projects-grid">
            <?php
            
                 $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                 $project_post_args = array(                 
                        'post_type' => 'project',
                        'order'     => 'DESC',
                        'orderby'   => 'date',
                        'posts_per_page' => get_theme_mod( 'ptf_projects_per_page' ),
                        'paged' => $paged
                     );

                 $wp_query = new WP_Query( $project_post_args );
                 
                 // Starts the loop
                 if ( $wp_query -> have_posts() ) : while ( $wp_query -> have_posts() ) : $wp_query -> the_post();
                            
                 // Get each term associated with the post
                 $project_terms = get_the_terms( $post -> id, "project-categories" );
                 $project_cats = null;

                 if ( !empty( $project_terms ) ) {

                     foreach ( $project_terms as $term ) {
                         
                         $project_cats .= strtolower( $term -> slug ) . ' ';
                                                 
                     }
                }

            ?>
             
            <div class="col-md-3 col-sm-6 project-item <?php echo esc_attr( $project_cats ); ?>">
                <article class="project-post">
                    <a href="<?php the_permalink(); ?>" class="project-link"><div class="project-overlay"></div>
                        <div class="project-hover">
                            <h5 class="project-title"><?php the_title(); ?></h5>
                            <p class="project-category">
                                <?php echo strip_tags( get_the_term_list ( get_the_ID(), 'project-categories', '', ' / ' ) ); ?>
                            </p>
                        </div>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="image-placeholder">
                                <?php the_post_thumbnail('ptf-project-thumb'); ?>
                            </div>
                        <?php endif; ?>
                    </a>
                </article>
            </div>
            <?php endwhile; endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
   <?php ptf_paging_nav(); ?>
</div>
<?php get_footer(); ?>