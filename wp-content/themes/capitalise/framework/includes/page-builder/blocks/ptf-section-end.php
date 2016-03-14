<?php
/**
 * Section End Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

if( ! class_exists( 'PTF_Section_End_Block') ) :

class PTF_Section_End_Block extends AQ_Block {

    function __construct() {
        $block_options = array(
            'name'      => __( 'Section End', 'artcore' ),
            'size'      => 'span12',
            'resizable' => 0,
        );      
        parent::__construct( 'PTF_Section_End_Block', $block_options );      
    }
    
    function form( $instance ){
        
        $defaults = array(
            'parallax'    => '',
            'layout_mode' => 'standard'
        );
        
        $instance = wp_parse_args($instance, $defaults);
        extract( $instance );
        
        $section_layout = array(
            'standard'  => __( 'Standard', 'artcore' ),
            'full-width'=> __( 'Full Width', 'artcore' ),
        );   
         
        ?>
        <p class="description">
            <?php _e( 'Use this block with Section Start. In case of using parallax background settings, remember to enable this setting in this block too.', 'artcore' ); ?>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('text_color') ?>">
                <?php _e( 'Layout Mode', 'artcore');?>
                <?php echo aq_field_select( 'layout_mode', $block_id, $section_layout, $layout_mode ) ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('parallax') ?>">
                <?php _e( 'Enable Parallax Background', 'artcore');?>
                <?php echo aq_field_checkbox('parallax', $block_id, $parallax) ?>
            </label>
        </p>
        <?php
    }
    
    function block($instance) {
        extract( $instance );
        
        $parallax_wrapper = '';
        
        if ( $parallax == 1 || $parallax == true ) {
             $parallax_wrapper = '</div>' ; 
        }
        
        $container_wrapper =  '</div></div>';
        
        if ( $layout_mode == 'full-width' ) {
            $container_wrapper = '';
        }
        echo wp_kses_post( $parallax_wrapper . $container_wrapper . '</div><!-- Section End -->' );
    }

    function before_block($instance) {
        extract($instance);
        return;
    }

    function after_block($instance) {
        extract($instance);
        return;
    }
    
}

aq_register_block( 'PTF_Section_End_Block' );

endif;