<?php
/**
 * Team Member Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

if( ! class_exists( 'PTF_Text_Image_Block' ) ) :

class PTF_Text_Image_Block extends AQ_Block {

    function __construct() {
        $block_options = array(
            'name'      => __( 'Text & Image Box', 'artcore' ),
            'size'      => 'span6'
        );      
        parent::__construct( 'PTF_Text_Image_Block', $block_options );
    }
    
    function form($instance) {
        
        $defaults = array(
            'text'         => '',
            'filter'       => 0,
            'image'        =>  '',
            'image_align'  => 'left'
        );
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);
        
        $image_pos = array(
            'left'    => 'Left',
            'right'   => 'right',
            'center'  => 'center'
        );
        
        ?>
        <p class="description">
            <label for="<?php echo $this->get_field_id('title') ?>">
                <?php _e( 'Title (Optional)', 'artcore');?>
                <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('image') ?>">
                <?php _e( 'Image', 'artcore');?>
                <?php echo aq_field_upload('image', $block_id, $image, $media_type = 'image') ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('image_align') ?>">
                <?php _e( 'Image Align', 'artcore');?>
                <?php echo aq_field_select('image_align', $block_id, $image_pos, $image_align) ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('text') ?>">
                <?php _e( 'Content', 'artcore');?>
                <?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
            </label>
            <label for="<?php echo $this->get_field_id('filter') ?>">
                <?php echo aq_field_checkbox('filter', $block_id, $filter) ?>
                <?php _e('Automatically add paragraphs', 'artcore') ?>
            </label>
        </p>
        
        <?php
    }
    
    function block($instance) {
        extract($instance);
        
        $image_cols = 'col-md-4 col-sm-4';
        $text_cols = 'col-md-8  col-sm-8';
        $image_output = '';
        $text_output = '';
        $text_format = '';
        
        // Change the columns so each block stand in the top of other
        if ( $image_align == 'center' ) {
            $image_cols = 'col-md-12';
            $text_cols = 'col-md-12';
            
        } 
        
        // Build the output for the image using proper markup according choices
        if ( !empty($image) ) {           
            $image_output = '<div class="'. $image_cols .'">';
            $image_output .= '<div class="single-image">';
            $image_output .= '<img src="' . $image  . '" alt="' .$title . '">';
            $image_output .= '</div>';
            $image_output .= '<div class="spacer"></div>';
            $image_output .= '</div>';
            
        }
        // This is related to the automatically add paragraphs fields 
        $wp_autop = ( isset($wp_autop) ) ? $wp_autop : 0;
        
        if($wp_autop == 1){
            $text_format = do_shortcode(htmlspecialchars_decode($text));
        } else {
            $text_format = wpautop(do_shortcode(htmlspecialchars_decode($text)));
        }
        
        // Build the output for the text using proper markup according choices
        $text_output = '<div class="'. $text_cols .'">';
        $text_output .= $text_format;
        $text_output .= '<div class="spacer"></div>';
        $text_output .= '</div>';
        
       
        // Outputs the columns to be left aligned
        if ( $image_align == 'left' ) {
            echo '<div class="row">';
        
            if ( !empty($image) ) {
                echo wp_kses_post( $image_output );
            }
            
            echo wp_kses_post( $text_output );           
            echo '</div>';
         
        // Outputs the colums to be righ aligned    
        } else if ( $image_align == 'right' ) {
           echo '<div class="row">';
           echo wp_kses_post( $text_output );
            
           if ( !empty($image) ) {
                echo wp_kses_post( $image_output );
            }
           
           echo '</div>';
           
        } else {
            echo '<div class="row">';
        
            if ( !empty($image) ) {
                echo wp_kses_post( $image_output );
            }
            
            echo wp_kses_post( $text_output );           
            echo '</div>';
        }

    }
}

aq_register_block( 'PTF_Text_Image_Block' );

endif;