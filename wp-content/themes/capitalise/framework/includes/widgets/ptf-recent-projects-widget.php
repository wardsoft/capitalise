<?php
/**
 * Recent Projects Widget.
 *
 * @package PlugFramework
 * @subpackage Artcore
 */
 
class PTF_Recent_Projects_Widget extends WP_Widget {
    
    public function __construct() {
        // Widget settings
        $widget_ops = array( 'classname' => 'recent-projects-widget', 'description' => __( 'Displays recent projects.', 'artcore') );
        
        // Create the widget calling the parent class construct method
        parent::__construct(
            'ptf_recent_projects_widget',
            __('Artcore Recent Projects', 'artcore'),
            $widget_ops
        );
    }
    
    public function form($instance) {
        
        // Set default widget settings
        $defaults = array('title' => __('Recent Projects', 'artcore' ), 'number' => 6 );
        $instance = wp_parse_args( (array) $instance, $defaults); ?>
          
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'artcore' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Numbers of items to show:', 'artcore' ); ?></label>
            <input type="text"  class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>" />
        </p>
 
    <?php
    }

    public function update($new_instance, $old_instance) {
            
        // Process Widget Options to be Saved
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = $new_instance['number'];
    
        return $instance;
    }
    
    public function widget($args, $instance) {
        
        // Outputs Content of the Widget
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];

        echo wp_kses_post( $before_widget );
        
        if( $title ) {
            echo $before_title . esc_html( $title ) . $after_title;
        } ?>
        
            
        <ul class="recent-projects">
            
            <?php
            
                $args = array(
                    'post_type' => 'project',
                    'posts_per_page' => $number,
                    'order'   => 'DESC'             
                );
            
                $recent_projects = new WP_Query($args);
                
                if ($recent_projects->have_posts()) :
                    
                    global $post;
                    
                    while( $recent_projects->have_posts() ) : $recent_projects->the_post();  ?>
                    
                     <li class="recent-project-item">
                         
                         <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                             <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'ptf-sidebar-project-thumb' ); ?>
                             <?php endif; ?>
                         </a>
                                                                         
                     </li>
                    
                <?php endwhile; ?>
                
            <?php endif; ?>
            
        </ul>
        
        <?php
        wp_reset_postdata(); 
        echo wp_kses_post( $after_widget );
    }
}

// Add Widget
if ( !function_exists( 'ptf_recent_projects_widget_init' ) ) {
    
    function ptf_recent_projects_widget_init() {
        register_widget('PTF_Recent_Projects_Widget'); 
    }
    
}

add_action('widgets_init', 'ptf_recent_projects_widget_init');
?>