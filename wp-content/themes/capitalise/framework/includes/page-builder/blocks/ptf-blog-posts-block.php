<?php
/**
 * Blog Posts Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */


if( !class_exists( 'PTF_Blog_Posts_Block' ) ) :

class PTF_Blog_Posts_Block extends AQ_Block {

    function __construct() {
        $block_options = array(
            'name' => __( 'Blog Posts', 'artcore'),
            'size' => 'span12',
            'resizable' => 0
        );
        
        //create the block
        parent::__construct('PTF_Blog_Posts_Block', $block_options);
    }

    function form($instance) {
        
        $defaults = array(
            'items_number'  => '3',
            'columns'       => 'three',
        );
        
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);
        
        $portfolio_columns = array(
            'one'     => __( 'One Column', 'artcore' ),
            'two'     => __( 'Two Columns', 'artcore' ),
            'three'   => __( 'Three Columns', 'artcore' ),
            'four'    => __( 'Four Columns', 'artcore' )
        );

        ?>  
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('items_number') ?>">
                <?php _e('Number of blog posts. Enter \'-1\' to display all items.','artcore' ); ?>
                <?php echo aq_field_input('items_number', $block_id, $items_number, 'min', 'number') ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('columns') ?>">
                <?php _e('Portfolio Columns','artcore' ); ?>
                <?php echo aq_field_select('columns', $block_id, $portfolio_columns, $columns) ?>
            </label>
        </p>    
         
        <?php
    }

    function block($instance) {
        extract($instance);
        
        $span = '';        
        if($columns == 'three') $span = 'col-md-4'; elseif($columns == 'four') $span = 'col-md-3'; elseif($columns == 'two') $span = 'col-md-6'; else $span = 'col-md-12';
                          
        global $post;   
        $query = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => $items_number
            ));

        if($query->have_posts()){
            while($query->have_posts()){
                $query->the_post();
                
                 
        ?>  
           <article class="blog-post col-sm-6 <?php echo esc_attr( $span ); ?>">
               <h5 class="blog-title">
                   <a href="<?php the_permalink(); ?>">
                       <?php if ( has_post_thumbnail() ) : ?>
                       <span class="blog-thumb">
                           <?php the_post_thumbnail( 'ptf-blog-grid-thumb' ); ?>
                           <span class="hover"></span>
                       </span>
                       <?php endif; ?>
                       <span class="blog-title-inner"><?php the_title(); ?></span>
                   </a>
               </h5>
               <div class="entry-content">
                   <span class="blog-meta"><?php the_category(', ') ?>, <?php the_time( get_option( 'date_format' ) ); ?></span>
                   <?php if ( strlen( get_the_excerpt()) > 0 ) : ?>
                                            
                        <?php the_excerpt(); ?>
                                                                                              
                        <p><a href="<?php the_permalink(); ?>" class="read-more"><?php _e( 'Continue Reading', 'artcore' ); ?></a></p>
                                        
                <?php endif; ?> 
               </div>
           </article>                               
        <?php
            }
        }

        wp_reset_postdata();       
                    
    }
    
    function before_block($instance) {
        extract($instance);
        echo '<div class="blog-isotope row">';
        
    }

    function after_block($instance) {
        extract($instance);
        echo '</div><!-- /.blog-isotope -->';

    }

}

aq_register_block( 'PTF_Blog_Posts_Block' );
endif;