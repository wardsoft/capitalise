<?php
/**
 * Testimonials Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */
 

if( !class_exists( 'PTF_Testimonials_Block' ) ) :

class PTF_Testimonials_Block extends AQ_Block {

    function __construct() {
        $block_options = array(
            'name' => __( 'Testimonials', 'artcore'),
            'size' => 'span12',
            'resizable' => 0
        );
        
        parent::__construct('PTF_Testimonials_Block', $block_options);
        
        //add ajax functions
        add_action('wp_ajax_aq_block_testimonial_add_new', array($this, 'add_testimonial'));
        
    }
    
    function form($instance) {
        $defaults = array(
            'testimonials' => array(
                1 => array(
                    'title'                 => __('Add New Testimonial', 'artcore'),
                    'testi_author'          => '',
                    'testi_author_position' => '',
                    'testi_content'         => ''                   
                )
            ),
            'column'        => 'two',
            'type'          => 'classic'
          
        );
        
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);

        $testimonial_columns = array(
            'one'     => __( 'One Column', 'artcore' ),
            'two'     => __( 'Two Columns', 'artcore' ),
            'three'   => __( 'Three Columns', 'artcore' ),
            'four'    => __( 'Four Columns', 'artcore' )
        );
        
        $testimonial_type = array(
            'classic'     => __( 'Classic', 'artcore' ),
            'carousel'    => __( 'Carousel', 'artcore' )
        );
        ?>
        <p class="description">
            <label for="<?php echo $this->get_field_id('column') ?>">
                <?php _e('Column Size','artcore' ); ?><br>
                <em><?php _e('NOTE: This option is only applicable for classic layout mode.','artcore' ); ?></em>
                <?php echo aq_field_select('column', $block_id, $testimonial_columns, $column) ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('type') ?>">
                <?php _e('Layout','artcore' ); ?>
                <?php echo aq_field_select('type', $block_id, $testimonial_type, $type) ?>
            </label>
        </p>
        
        <div class="description cf">
            <ul id="aq-sortable-list-<?php echo esc_attr($block_id); ?>" class="aq-sortable-list" rel="<?php echo esc_attr($block_id); ?>">
                <?php
                $testimonials = is_array($testimonials) ? $testimonials : $defaults['testimonials'];
                $count = 1;
                foreach($testimonials as $testimonial) {    
                    $this->testimonial($testimonial, $count);
                    $count++;
                }
                ?>
            </ul>
            <p></p>
            <a href="#" rel="testimonial" class="aq-sortable-add-new button"><?php _e( 'Add New', 'artcore' ); ?></a>
            <p></p>
        </div>
        <?php
    }
    function testimonial($testimonial = array(), $count = 0) {
        
        ?>
        <li id="<?php echo $this->get_field_id('testimonials') ?>-sortable-item-<?php echo esc_attr($count); ?>" class="sortable-item" rel="<?php echo esc_attr($count); ?>">
            
            <div class="sortable-head cf">
                <div class="sortable-title">
                    <strong><?php echo esc_html($testimonial['title']); ?></strong>
                </div>
                <div class="sortable-handle">
                    <a href="#"><?php _e('Open / Close', 'artcore' ); ?></a>
                </div>
            </div>
            
            <div class="sortable-body">
                <p class="testimonial-desc description">
                    <label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo esc_attr($count); ?>-title">
                        <?php _e('Title', 'artcore' ); ?>
                        <input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo esc_attr($count); ?>-title" class="input-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo esc_attr($count); ?>][title]" value="<?php echo esc_attr($testimonial['title']); ?>" />
                    </label>
                </p>
                <p class="testimonial-desc description">
                    <label for="<?php echo $this->get_field_id('testi_author') ?>-<?php echo esc_attr($count); ?>-testi_author">
                        <?php _e('Author', 'artcore' ); ?><br>
                        <em><?php _e( 'Enter the testimonial author.', 'artcore' ); ?></em>
                        <input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo esc_attr($count); ?>-testi_author" class="input-full show-icon" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo esc_attr($count); ?>][testi_author]" value="<?php echo esc_attr($testimonial['testi_author']); ?>" />
                    </label>
                </p>
                <p class="testimonial-desc description">
                    <label for="<?php echo $this->get_field_id('testi_author_position') ?>-<?php echo esc_attr($count); ?>-testi_author_position">
                        <?php _e('Author position', 'artcore' ); ?><br>
                        <em><?php _e( 'Enter the testimonial author position (Example: CEO).', 'artcore' ); ?></em>
                        <input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo esc_attr($count); ?>-testi_author_position" class="input-full show-icon" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo esc_attr($count); ?>][testi_author_position]" value="<?php echo esc_attr($testimonial['testi_author_position']); ?>" />
                    </label>
                </p>
                               
                <p class="testimonial-desc description">
                    <label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo esc_attr($count); ?>-testi_content">
                        <?php _e('Content', 'artcore' ); ?>
                        <textarea id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo esc_attr($count); ?>-testi_content" class="textarea-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo esc_attr($count); ?>][testi_content]" rows="5"><?php echo esc_textarea($testimonial['testi_content']); ?></textarea>
                    </label>
                </p>
                
                <p class="testimonial-desc description"><a href="#" class="sortable-delete"><?php _e('Delete','artcore' ); ?></a></p>
            </div>
                       
        </li>
        <?php
    }
    
    function block($instance) {
        extract($instance);
        $i = 1;
        $output = '';
        $span = '';
        
        if ( $type == 'carousel') echo '<ul class="slides">';
        
        if($column == 'three') $span = 'col-md-4'; elseif($column == 'four') $span = 'col-md-3'; elseif($column == 'two') $span = 'col-md-6'; else $span = 'col-md-12';
        
        foreach( $testimonials as $testimonial ) {
            
            if ( $type == 'classic' ) {
                           
                $output .=
                    '<div class="' .$span. ' col-sm-6">
                                <div class="client-quote">
                                    <p class="description">' . $testimonial['testi_content'] . '</p>
                                    <p><strong>'. $testimonial['testi_author'] . ', </strong>'. $testimonial['testi_author_position'] . '</p>
                                </div>
                           </div>';
                
                if($i%2 == 0 && $i != sizeof($testimonials) && $span == 'col-md-6') $output .= '<div class="clear"></div>';
                if($i%3 == 0 && $i != sizeof($testimonials) && $span == 'col-md-4') $output .= '<div class="clear"></div>'; 
                if($i%4 == 0 && $i != sizeof($testimonials) && $span == 'col-md-3') $output .= '<div class="clear"></div>';
                $i++;
                
            } else {
                
                $output .= '
                    <li class="testimonial-item">
                        <p>'. $testimonial['testi_content']. '</p>
                        <div class="testimonial-author"><strong>' . $testimonial['testi_author']. '</strong>, '.$testimonial['testi_author_position'].'</div>
                    </li>';
                
            }

        }

        echo wp_kses_post( $output );
        
         if ( $type == 'carousel') echo '</ul>';
        
    }
    
    /* AJAX add testimonial */
    function add_testimonial() {
        $nonce = $_POST['security'];    
        if ( !wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
        
        $count = isset($_POST['count']) ? absint($_POST['count']) : false;
        $this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
        
        //default key/value for the testimonial
        $testimonial = array(
            'title'     => __('Add New Testimonial', 'artcore'),
            'testi_author'          => '',
            'testi_author_position' => '',
            'testi_content'         => '' 
        );
        
        if($count) {
            $this->testimonial($testimonial, $count);
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
        
        // Print aditional markup if we have a carousel testimonial block
        if ( $type == 'carousel') {
            
            echo '<div class="col-sm-12 text-center"><div class="flexslider carousel testimonials">';
                       
        } else {
            
            return;
            
        }
    }

    function after_block($instance) {
        extract($instance);
        
        // Print aditional markup if we have a carousel testimonial block
        if ( $type == 'carousel') {            
            echo '</div></div>';              
        } else {           
            return;  
        }
       
    }
    
}

aq_register_block( 'PTF_Testimonials_Block' );

endif;