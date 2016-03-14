<?php
/**
 * Text Heading Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

if( !class_exists( 'PTF_Heading_Block' ) ) :

class PTF_Heading_Block extends AQ_Block {

    function __construct() {
        $block_options = array(
            'name'      => __( 'Heading', 'artcore' ),
            'size'      => 'span12',
            'resizable' => 0,
        );      
        parent::__construct( 'PTF_Heading_Block', $block_options );
    }
    
    function form( $instance ){
        $defaults = array(
            'heading_text'          => '',
            'subheading_text'       => '',
            'heading_color'         => '#3e3e3e',
            'subheading_color'      => '#6e6e6e',
            'heading_align'         => 'text-center',            
            'padding_top'           => '0',
            'padding_bottom'        => '60',
        );
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);
        
        $text_align = array(
            'text-left'     => 'Left',
            'text-right'    => 'Right',
            'text-center'   => 'Center'
        );
        
        ?>
        <p class="description">
            <label for="<?php echo $this->get_field_id('heading_text') ?>">
                <?php _e( 'Heading Text', 'artcore');?>
                <?php echo aq_field_input( 'heading_text', $block_id, $heading_text ); ?>
            </label>
        </p>
        <p class="description">
            <label for="<?php echo $this->get_field_id('heading_color') ?>">
                <?php _e( 'Heading Color', 'artcore');?>
                <?php echo aq_field_color_picker('heading_color', $block_id, $heading_color) ?>
            </label>
        </p>
         <p class="description">
            <label for="<?php echo $this->get_field_id('subheading_text') ?>">
                <?php _e( 'Subheading Text', 'artcore');?>
                <?php echo aq_field_input( 'subheading_text', $block_id, $subheading_text ); ?>
            </label>
        </p>         
         <p class="description">
            <label for="<?php echo $this->get_field_id('subheading_color') ?>">
                <?php _e( 'Subheading Color', 'artcore');?>
                <?php echo aq_field_color_picker('subheading_color', $block_id, $subheading_color) ?>
            </label>
        </p>
        <p class="description">
            <label for="<?php echo $this->get_field_id('heading_align') ?>">
                <?php _e( 'Text Align', 'artcore');?>
                <?php echo aq_field_select('heading_align', $block_id, $text_align, $heading_align) ?>
            </label>
        </p>
        <p class="description">
            <label for="<?php echo $this->get_field_id( 'padding_top' ) ?>">
                <?php _e( 'Padding top', 'artcore');?>
                <?php echo aq_field_input( 'padding_top', $block_id, $padding_top, $size = 'min', $type = 'number' ) ?>px
            </label>
            &nbsp;&nbsp;-&nbsp;&nbsp;
            <label for="<?php echo $this->get_field_id( 'padding_bottom' ) ?>">
                <?php _e( 'Padding Bottom', 'artcore');?>
                <?php echo aq_field_input( 'padding_bottom', $block_id, $padding_bottom, $size = 'min', $type = 'number' ) ?>px
            </label>
        </p>        
 
        <?php
    }
    
    function block( $instance ) {
        extract( $instance );
        
        $heading_text           = ( ! empty ( $heading_text )) ? $heading_text : '';
        $subheading_text        = ( ! empty ( $subheading_text )) ? $subheading_text : '';       
        $heading_color          = ( ! empty ( $heading_color ) ) ? 'color:'. $heading_color .';' : '';
        $subheading_color       = ( ! empty ( $subheading_color ) ) ? 'color:'. $subheading_color .';' : '';
        $heading_align          = ( ! empty ( $heading_align )) ? $heading_align : '';       
        $padding_top            = ( ! empty ( $padding_top ) ) ? 'padding-top:'. (int)$padding_top .'px;': '';
        $padding_bottom         = ( ! empty ( $padding_bottom ) ) ? 'padding-bottom:'. (int)$padding_bottom .'px;': '';
            
        $style_wrapper = (
            ! empty( $padding_bottom ) ||
            ! empty( $padding_top ) ) ? 
                sprintf( '%s %s', $padding_bottom, $padding_top) : '';
        $css_wrapper= '';
        if ( ! empty( $style_wrapper ) ) {          
            $css_wrapper= 'style="'. $style_wrapper .'" ';
        }

        ?>
        
        <div class="clearfix section-header" <?php echo wp_kses_post( $css_wrapper ); ?>>
             <div class="col-sm-12 <?php echo esc_attr( $heading_align ); ?>">
                 <h3 style="<?php echo esc_attr( $heading_color ); ?>"><?php echo esc_html( $heading_text ); ?></h3>
                 
                 <?php if ( !empty( $subheading_text ) ) : ?>                     
                    <p style="<?php echo esc_attr( $subheading_color ); ?>"><?php echo esc_html( $subheading_text ); ?></p>                    
                 <?php endif; ?>
                 
            </div>
        </div>

    <?php    
    }

    function before_block( $instance ) {
        extract( $instance );
        return;
    }

    function after_block( $instance ) {
        extract( $instance );
        return;
    }
    
}

aq_register_block( 'PTF_Heading_Block' );

endif;