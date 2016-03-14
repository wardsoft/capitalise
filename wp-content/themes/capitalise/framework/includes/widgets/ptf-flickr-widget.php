<?php
/**
 * Flickr Feed Widget.
 *
 * @package PlugFramework
 * @subpackage Artcore
 */
 
class PTF_Flickr_Widget extends WP_Widget {
    
    public function __construct() {
        // Widget settings
        $widget_ops = array( 'classname' => 'flickr-feed-widget', 'description' => __( 'Displays a flickr feed.', 'artcore') );
        
        // Create the widget calling the parent class construct method
        parent::__construct(
            'ptf_flickr_widget',
            __('Artcore Flickr Feed', 'artcore'),
            $widget_ops
        );
    }
    
    public function form($instance) {
        
        // Set default widget settings
        $defaults = array('title' => __('Flickr Feed', 'artcore' ), 'number' => 6, 'feed_id' => '56174287@N02');
        $instance = wp_parse_args( (array) $instance, $defaults); ?>
          
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'artcore' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('feed_id'); ?>"><?php _e('Flickr id', 'artcore' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('feed_id'); ?>" name="<?php echo $this->get_field_name('feed_id'); ?>" value="<?php echo esc_attr($instance['feed_id']); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Numbers of items to show:', 'artcore' ); ?></label>
            <input type="text"  class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
        </p>
              
    <?php
    }

    public function update($new_instance, $old_instance) {
            
        // Process Widget Options to be Saved
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = $new_instance['number'];
        $instance['feed_id'] = $new_instance['feed_id'];
  
    
        return $instance;
    }
    
    public function widget($args, $instance) {
        
        // Outputs Content of the Widget
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        $feed_id = $instance['feed_id'];
        
        $widget_id =  rand();

        echo wp_kses_post( $before_widget );
        
        if( $title ) {
            echo $before_title . esc_html($title) . $after_title;
        } ?>
        
        <div class="flickr-feed">
            <ul class="flickr-images" id="flickr-images-<?php echo esc_attr( $widget_id ); ?>"></ul>
        </div>
            
        <script>
        jQuery(document).ready(function ($) {
             // Flickr Images
            jQuery('#flickr-images-<?php echo esc_attr( $widget_id ); ?>').jflickrfeed({
                limit: <?php echo json_encode($number, JSON_NUMERIC_CHECK ); ?> ,
                qstrings: { id: <?php echo wp_json_encode( $feed_id ); ?> },
                itemTemplate: '<li class="small-thumb"><a href="{{link}}" title="{{title}}"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
            });
        });
        </script>

        <?php
       
        echo wp_kses_post( $after_widget );
    }
}

// Add Widget
if ( !function_exists( 'ptf_flickr_widget_init' ) ) {
    
    function ptf_flickr_widget_init() {
        register_widget('PTF_Flickr_Widget'); 
    }
    
}

add_action('widgets_init', 'ptf_flickr_widget_init');
?>