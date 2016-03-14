<?php
/**
 * Call to Action Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

if( ! class_exists( 'PTF_CTA_Block' ) ) :

    class PTF_CTA_Block extends AQ_Block {
    
        function __construct() {
            $block_options = array(
                'name'      => __( 'Call to Action', 'artcore' ),
                'size'      => 'span12',
                'resizable' => 0
            );      
            parent::__construct( 'PTF_CTA_Block', $block_options );
        }
        
        function form( $instance ){
            $defaults = array(
                'cta_text'             => '',
                'cta_button_text'      => '',
                'cta_button_url'       => '#',
                'cta_button_target'    => '',
                'cta_show_button'      => 'true',
                'cta_bg_color'         => '#fff'
                           
            );
            
            $instance = wp_parse_args($instance, $defaults);
            extract($instance);
            
            $button_target = array(
                '_self'  => __( 'Same Window', 'artcore' ),
                '_blank' =>  __( 'New Window', 'artcore' ),
            );
                    
            
            ?>
            
            <p class="description">
                <label for="<?php echo $this->get_field_id('cta_text') ?>">
                    <?php _e( 'Call to Action Text', 'artcore');?>
                    <?php echo aq_field_input( 'cta_text', $block_id, $cta_text ); ?>
                </label>
            </p>
                  
            <p class="description half">
                <label for="<?php echo $this->get_field_id('cta_button_text') ?>">
                    <?php _e( 'Button Text', 'artcore');?>
                    <?php echo aq_field_input( 'cta_button_text', $block_id, $cta_button_text ); ?>
                </label>
            </p>
            
            <p class="description half last">
                <label for="<?php echo $this->get_field_id('cta_button_url') ?>">
                    <?php _e( 'Button URL', 'artcore');?>
                    <?php echo aq_field_input( 'cta_button_url', $block_id, $cta_button_url ); ?>
                </label>
            </p>
            
            <p class="description">
                <label for="<?php echo $this->get_field_id('cta_button_target') ?>">
                    <?php _e( 'Button URL Target', 'artcore');?>
                    <?php echo aq_field_select( 'cta_button_target', $block_id, $button_target, $cta_button_target ) ?>
                </label>
            </p>
            
            <p class="description">
                <label for="<?php echo $this->get_field_id( 'cta_show_button' ) ?>">
                    <?php _e( 'Show Button?', 'artcore');?>
                    <?php echo aq_field_checkbox( 'cta_show_button', $block_id, $cta_show_button ) ?>
                </label>
            </p>
     
     
            <?php
        }
        
        function block( $instance ) {
            extract( $instance );
            
            ?>
            
            <div class="call-to-action">
                <div class="cta-inner clearfix">
                     <div class="cta-text">
                        <h5 class="cta-title"><?php echo esc_html( $cta_text ); ?></h5>
                     </div>
                     
                     <?php if ( $cta_show_button == 1 || $cta_show_button == 'true' ): ?>
                         
                         <div class="cta-button">
                            <a target="<?php echo esc_attr( $cta_button_target ); ?>" href="<?php echo esc_url( $cta_button_url ); ?>" class="btn btn-bordered"><?php echo esc_html( $cta_button_text ); ?></a>
                         </div>
                         
                   <?php endif; ?>  
                            
               </div>
           </div>       
    
        <?php    
        }
    }
    
    aq_register_block( 'PTF_CTA_Block' );

endif;