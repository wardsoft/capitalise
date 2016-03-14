<?php
/**
 * Services Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */
 

if(!class_exists('PTF_Service_Block')) :

class PTF_Service_Block extends AQ_Block {

    function __construct() {
        $block_options = array(
            'name' => __( 'Service Box', 'artcore'),
            'size' => 'span12',
            'resizable' => 0
        );
        
        //create the widget
        parent::__construct('PTF_Service_Block', $block_options);
        
        //add ajax functions
        add_action('wp_ajax_aq_block_service_add_new', array( $this, 'add_service' ) );
        
    }
    
    function form($instance) {
        $defaults = array(
            'services' => array(
                1 => array(
                    'title'     => __('Add New Service', 'artcore'),
                    'icon_font' => '',
                    'content'   => '',
                    'read_more_url' => '#',
                    'read_more_label' =>  __('Read More', 'artcore'),                  
                )
            ),
            'column'        => 'three'
        );
        
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);

        $service_columns = array(
            'one'     => __( 'One Column', 'artcore' ),
            'two'     => __( 'Two Columns', 'artcore' ),
            'three'   => __( 'Three Columns', 'artcore' ),
            'four'    => __( 'Four Columns', 'artcore' )
         );
        ?>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('column') ?>">
                <?php _e('Column Size','artcore' ); ?>
                <?php echo aq_field_select('column', $block_id, $service_columns, $column) ?>
            </label>
        </p>
        
        <div class="description cf">
            <ul id="aq-sortable-list-<?php echo esc_attr( $block_id ); ?>" class="aq-sortable-list" rel="<?php echo esc_attr( $block_id ); ?>">
                <?php
                $services = is_array($services) ? $services : $defaults['services'];
                $count = 1;
                foreach($services as $service) {    
                    $this->service($service, $count);
                    $count++;
                }
                ?>
            </ul>
            <p></p>
            <a href="#" rel="service" class="aq-sortable-add-new button"><?php _e( 'Add New', 'artcore' ); ?></a>
            <p></p>
        </div>
        <?php
    }
    function service($service = array(), $count = 0) {
        
        //global $include_animation ;
        ?>
        <li id="<?php echo $this->get_field_id('services') ?>-sortable-item-<?php echo esc_attr( $count ); ?>" class="sortable-item" rel="<?php echo esc_attr( $count ); ?>">
            
            <div class="sortable-head cf">
                <div class="sortable-title">
                    <strong><?php echo esc_html( $service['title'] ) ?></strong>
                </div>
                <div class="sortable-handle">
                    <a href="#"><?php _e('Open / Close', 'artcore' ); ?></a>
                </div>
            </div>
            
            <div class="sortable-body">
                <p class="service-desc description">
                    <label for="<?php echo $this->get_field_id('services') ?>-<?php echo esc_attr($count); ?>-title">
                        <?php _e('Title', 'artcore' ); ?>
                        <input type="text" id="<?php echo $this->get_field_id('services') ?>-<?php echo esc_attr($count); ?>-title" class="input-full" name="<?php echo $this->get_field_name('services') ?>[<?php echo esc_attr($count); ?>][title]" value="<?php echo esc_attr($service['title']); ?>" />
                    </label>
                </p>
                <p class="service-desc description">
                    <label for="<?php echo $this->get_field_id('services') ?>-<?php echo esc_attr($count); ?>-icon_font">
                        <?php _e('Icon', 'artcore' ); ?><br>
                        <em><?php _e( 'Enter the desired icon class. Example: fa fa-gear', 'artcore' ); ?></em>
                        <input type="text" id="<?php echo $this->get_field_id('services') ?>-<?php echo esc_attr($count); ?>-icon_font" class="input-full show-icon" name="<?php echo $this->get_field_name('services') ?>[<?php echo esc_attr($count); ?>][icon_font]" value="<?php echo esc_attr($service['icon_font']); ?>" />
                    </label>
                </p>
                
                <p class="service-desc description">
                    <label for="<?php echo $this->get_field_id('services') ?>-<?php echo esc_attr($count); ?>-read_more_url">
                        <?php _e('Read More URL', 'artcore' ); ?><br>
                        <em><?php _e( 'Enter the url for the read more text. Example: http://mysite.com', 'artcore' ); ?></em>
                        <input type="text" id="<?php echo $this->get_field_id('services') ?>-<?php echo esc_attr($count); ?>-read_more_url" class="input-full read-more-url" name="<?php echo $this->get_field_name('services') ?>[<?php echo esc_attr($count); ?>][read_more_url]" value="<?php echo esc_attr($service['read_more_url']); ?>" />
                    </label>
                </p>
                
                <p class="service-desc description">
                    <label for="<?php echo $this->get_field_id('services') ?>-<?php echo esc_attr($count); ?>-read_more_label">
                        <?php _e('Read More Text Label', 'artcore' ); ?><br>
                        <em><?php _e( 'Enter the label for the read more text.', 'artcore' ); ?></em>
                        <input type="text" id="<?php echo $this->get_field_id('services') ?>-<?php echo esc_attr($count); ?>-read_more_label" class="input-full read-more-label" name="<?php echo $this->get_field_name('services') ?>[<?php echo esc_attr($count); ?>][read_more_label]" value="<?php echo esc_attr($service['read_more_label']); ?>" />
                    </label>
                </p>
                               
                <p class="testimonial-desc description">
                    <label for="<?php echo $this->get_field_id('services') ?>-<?php echo esc_attr($count); ?>-content">
                        <?php _e('Content', 'artcore' ); ?>
                        <textarea id="<?php echo $this->get_field_id('services') ?>-<?php echo esc_attr($count); ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('services') ?>[<?php echo esc_attr($count); ?>][content]" rows="5"><?php echo esc_textarea($service['content']); ?></textarea>
                    </label>
                </p>
                
                <p class="service-desc description"><a href="#" class="sortable-delete"><?php _e('Delete','artcore' ); ?></a></p>
            </div>
            
        </li>
        <?php
    }
    
    function block($instance) {
        extract($instance);
        $i = 1;
        $output = '';
        $span = '';
        if($column == 'three') $span = 'col-md-4'; elseif($column == 'four') $span = 'col-md-3'; elseif($column == 'two') $span = 'col-md-6'; else $span= 'span12';
        
        foreach( $services as $service ) {           
            $output .='
                <div class="text-center service-post '.$span.'" >
                    <span class="service-icon '.$service['icon_font'].'"></span>
                    <h5 class="service-title">'.$service['title'].'</h5>
                    <p>'.$service['content'].'</p>';
                
            if ( $service['read_more_url'] && $service['read_more_label'] != '' ) {
                $output .= '<a href="'.$service['read_more_url'].'">'.$service['read_more_label'].'</a>';
            }
            
            $output .='
                    <div class="spacer"></div>                    
                </div>';
            
            if($i%2 == 0 && $i != sizeof($services) && $span == 'col-md-6') $output .= '<div class="clear"></div>';
            if($i%3 == 0 && $i != sizeof($services) && $span == 'col-md-4') $output .= '<div class="clear"></div>'; 
            if($i%4 == 0 && $i != sizeof($services) && $span == 'col-md-3') $output .= '<div class="clear"></div>';
            
            $i++;
        }
        
        echo wp_kses_post( $output );
        
    }
    
    /* AJAX add service */
    function add_service() {
        $nonce = $_POST['security'];    
        if (!wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
        
        $count = isset($_POST['count']) ? absint($_POST['count']) : false;
        $this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
        
        //default key/value for the service
        $service = array(
            'title'     => __('Add New Service', 'artcore'),
            'icon_font' => '',
            'content'   => '',
            'read_more_url' => '#',
            'read_more_label' =>  __('Read More', 'artcore'), 
        );
        
        if($count) {
            $this->service($service, $count);
        } else {
            die(-1);
        }
        
        die();
    }
    
    function update($new_instance, $old_instance) {
        $new_instance = aq_recursive_sanitize($new_instance);
        return $new_instance;
    }

    function before_block($instance) {
        extract($instance);
        echo '<div class="services-wrapper">';
    }

    function after_block($instance) {
        extract($instance);
        echo '</div>';
    }
    
}

aq_register_block( 'PTF_Service_Block' );

endif;