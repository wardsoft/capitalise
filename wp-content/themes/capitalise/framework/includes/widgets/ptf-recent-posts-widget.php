<?php
/**
 * Recent Posts Widget.
 *
 * @package PlugFramework
 * @subpackage Artcore
 */
 
class PTF_Recent_Posts_Widget extends WP_Widget {
    
    public function __construct() {
        // Widget settings
        $widget_ops = array( 'classname' => 'recent-posts-widget', 'description' => __( 'Displays recent posts.', 'artcore') );
        
        // Create the widget calling the parent class construct method
        parent::__construct(
            'ptf_recent_posts_widget',
            __('Artcore Recent Posts', 'artcore'),
            $widget_ops
        );
    }
    
    public function form($instance) {
        
        // Set default widget settings
        $defaults = array('title' => __('Recent Posts', 'artcore' ), 'number' => 3, 'show_date' => true, 'show_thumb' => true);
        $instance = wp_parse_args( (array) $instance, $defaults); ?>
          
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'artcore' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Numbers of items to show:', 'artcore' ); ?></label>
            <input type="text"  class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
        </p>
        
        <p>            
            <input type="checkbox"  class="checkbox" id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" <?php checked( $instance['show_date'], 'on' ); ?> />
            <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Show post date?', 'artcore' ); ?></label>
        </p>
        
        <p>            
            <input type="checkbox"  class="checkbox" id="<?php echo $this->get_field_id('show_thumb'); ?>" name="<?php echo $this->get_field_name('show_thumb'); ?>" <?php checked( $instance['show_thumb'], 'on' ); ?> />
            <label for="<?php echo $this->get_field_id('show_thumb'); ?>"><?php _e('Show post thumbnail?', 'artcore' ); ?></label>
        </p>
        
    <?php
    }

    public function update($new_instance, $old_instance) {
            
        // Process Widget Options to be Saved
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = $new_instance['number'];
        $instance['show_date'] = $new_instance['show_date'];
        $instance['show_thumb'] = $new_instance['show_thumb'];
    
        return $instance;
    }
    
    public function widget($args, $instance) {
        
        // Outputs Content of the Widget
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        $show_date = $instance['show_date'];
        $show_thumb = $instance['show_thumb'];

        echo wp_kses_post( $before_widget );
        
        if( $title ) {
            echo $before_title . esc_html( $title ) . $after_title;
        } ?>
        
            
        <ul class="recent-posts">
            
            <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $number,
                    'order'   => 'DESC'             
                );
            
                $recent_posts = new WP_Query($args);
                
                if ($recent_posts->have_posts()) :
                    
                    global $post;
                    
                    while( $recent_posts->have_posts() ) : $recent_posts->the_post();  ?>
                    
                     <li class="recent-post-item">
                         
                         <a href="<?php the_permalink(); ?>">
                             
                          <?php if ( $show_thumb ) : ?>
                             <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'ptf-sidebar-thumb' ); ?>
                             <?php endif; ?>
                          <?php endif; ?>
                          
                             <span class="post-title"><?php the_title(); ?></span>
                             
                         </a>
                         
                         <?php if ( $show_date ) : ?>
                            <span class="post-meta"><?php the_time( get_option( 'date_format' ) ); ?></span>
                         <?php endif; ?>
                         
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
if ( !function_exists( 'ptf_recent_posts_widget_init' ) ) {
    
    function ptf_recent_posts_widget_init() {
        register_widget('PTF_Recent_Posts_Widget'); 
    }
    
}

add_action('widgets_init', 'ptf_recent_posts_widget_init');
?>