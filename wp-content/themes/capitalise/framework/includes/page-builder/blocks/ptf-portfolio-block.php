<?php
/**
 * Portfolio Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */


if( ! class_exists( 'PTF_Portfolio_Block' ) ) :

class PTF_Portfolio_Block extends AQ_Block {

    function __construct() {
        $block_options = array(
            'name' => __( 'Portfolio', 'artcore' ),
            'size' => 'span12',
            'resizable' => 0
        );
        
        //create the block
        parent::__construct('PTF_Portfolio_Block', $block_options);
    }

    function form($instance) {
        
        $defaults = array(
            'items_number'  => '4',
            'columns'       => 'four',
            'portfolio_category' => 'all',
        );
        
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);
        
        $portfolio_columns = array(
            'one'     => __( 'One Column', 'artcore' ),
            'two'     => __( 'Two Columns', 'artcore' ),
            'three'   => __( 'Three Columns', 'artcore' ),
            'four'    => __( 'Four Columns', 'artcore' )
        );
        
        $portfolio_categories = array( 'all' => __( 'All', 'artcore' ) );
        
        $category_args = array( 'taxonomy' => 'project-categories' );

        if ( !empty( $category_args ) ) {
            $categories = get_categories( $category_args );
            foreach ( $categories as $category ) {
                $portfolio_categories[ sanitize_title( $category -> name ) ] = $category -> name;
                
            }
        }
            

        ?>  
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('items_number') ?>">
                <?php _e('Number of portfolio items. Enter \'-1\' to display all items.','artcore' ); ?>
                <?php echo aq_field_input('items_number', $block_id, $items_number, 'min', 'number') ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('columns') ?>">
                <?php _e('Portfolio Columns','artcore' ); ?>
                <?php echo aq_field_select('columns', $block_id, $portfolio_columns, $columns) ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('portfolio_category') ?>">
                <?php _e('Portfolio Category','artcore' ); ?>
                <?php echo aq_field_select('portfolio_category', $block_id, $portfolio_categories, $portfolio_category) ?>
            </label>
        </p>        
         
        <?php
    }

    function block($instance) {
        extract($instance);
        
        // Get all the categories terms associated with the project-categories taxonomy
        $portfolio_terms = get_terms( 'project-categories' );
        $portfolio_term = null;
        
        // Check for all or a specific category
        if ( $portfolio_category == 'all' ) {
            $portfolio_term = wp_list_pluck( $portfolio_terms, 'slug' );
        } else {
            $portfolio_term = $portfolio_category;
        }
        
        $span = '';        
        if($columns == 'three') $span = 'col-md-4'; elseif($columns == 'four') $span = 'col-md-3'; elseif($columns == 'two') $span = 'col-md-6'; else $span = 'col-md-12';
                          
        global $post;
           
        $query = new WP_Query(array(
                'post_type'      => 'project',
                'posts_per_page' => $items_number,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'project-categories',
                        'field'    => 'slug',
                        'terms'    => $portfolio_term,
                    ),
                ),
                
            ));

        if( $query->have_posts() ){
            while( $query->have_posts() ) {
                $query->the_post();
                            
        ?>  
           <article class="project-post <?php echo esc_attr( $span); ?>">
               <a href="<?php the_permalink(); ?>" class="project-link">
                   <div class="project-overlay"></div>
                   <div class="project-hover">
                       <h5 class="project-title"><?php the_title(); ?></h5>
                       <p class="project-category"><?php echo strip_tags( get_the_term_list ( get_the_ID(), 'project-categories', '', ' / ' ) ); ?></p>
                   </div>
                   <?php if ( has_post_thumbnail() ) : ?>
                       <div class="image-placeholder">
                            <?php the_post_thumbnail( 'ptf-project-thumb' ); ?>
                       </div>
                   <?php endif; ?>
               </a>
           </article>                               
        <?php
            }
        }

        wp_reset_postdata();       
                    
    }
    
    function before_block($instance) {
        extract($instance);
        echo '<div class="projects-holder clearfix">';
        
    }

    function after_block($instance) {
        extract($instance);
        echo '</div><!-- /.projects-holder -->';

    }

}

aq_register_block( 'PTF_Portfolio_Block' );
endif;