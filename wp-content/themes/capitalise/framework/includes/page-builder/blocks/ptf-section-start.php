<?php
/**
 * Section Start Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

if( ! class_exists( 'PTF_Section_Start_Block' ) ) :

class PTF_Section_Start_Block extends AQ_Block {

    function __construct() {
        $block_options = array(
            'name'      => __( 'Section Start', 'artcore' ),
            'size'      => 'span12',
            'resizable' => 0,
        );      
        parent::__construct( 'PTF_Section_Start_Block', $block_options );
    }
    
    function form( $instance ){
        $defaults = array(
            'title'                 => __( 'New Page Section', 'artcore' ),
            'bg_color'              => '#ffffff',
            'position'              => 'top left',
            'image'                 => '',
            'repeat'                => 'repeat',
            'text_color'            => '',
            'parallax'              => '',
            'padding_top'           => '60',
            'padding_bottom'        => '60',       
            'layout_mode'           => 'standard',
        );
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);
                     
        $bg_repeat = array(
            'repeat'    => 'repeat',
            'no-repeat' => 'no-repeat'
        );
        
        $section_layout = array(
            'standard'  => __( 'Standard', 'artcore' ),
            'full-width'=> __( 'Full Width', 'artcore' ),
        );
        
        
        ?>
        <p class="description">
            <label for="<?php echo $this->get_field_id('title') ?>">
                <?php _e( 'Section Title', 'artcore');?>            
                <?php echo aq_field_input( 'title', $block_id, $title ) ?>
            </label>
        </p>
         <p class="description">
            <label for="<?php echo $this->get_field_id('text_color') ?>">
                <?php _e( 'Layout Mode', 'artcore');?><br>
                <em><?php _e( 'NOTE: This setting must be setup in both Section Start and Section End blocks.', 'artcore');?></em>
                <?php echo aq_field_select( 'layout_mode', $block_id, $section_layout, $layout_mode ) ?>
            </label>
        </p>
        <p class="description">
            <label for="<?php echo $this->get_field_id( 'padding_top' ) ?>">
                <?php _e( 'Padding Top', 'artcore');?>
                <?php echo aq_field_input( 'padding_top', $block_id, $padding_top, $size = 'min', $type = 'number' ) ?>px
            </label>
            &nbsp;&nbsp;-&nbsp;&nbsp;
            <label for="<?php echo $this->get_field_id( 'padding_bottom' ) ?>">
                <?php _e( 'Padding Bottom', 'artcore');?>
                <?php echo aq_field_input( 'padding_bottom', $block_id, $padding_bottom, $size = 'min', $type = 'number' ) ?>px
            </label>
        </p>        
        <p class="description">
            <label for="<?php echo $this->get_field_id('image') ?>">
                <?php _e( 'Background Image', 'artcore');?>
                <?php echo aq_field_upload('image', $block_id, $image, $media_type = 'image') ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('bg_color') ?>">
                <?php _e( 'Background Color', 'artcore');?>
                <?php echo aq_field_color_picker('bg_color', $block_id, $bg_color) ?>
            </label>
        </p>
        <p class="description">
            <label for="<?php echo $this->get_field_id('position') ?>">
                <?php _e( 'Background Position', 'artcore');?>
                <?php echo aq_field_input('position', $block_id, $position) ?>
            </label>
        </p>
        <p class="description">
            <label for="<?php echo $this->get_field_id('repeat') ?>">
                <?php _e( 'Background Repeat ?', 'artcore');?>
                <?php echo aq_field_select('repeat', $block_id, $bg_repeat, $repeat) ?>
            </label>
        </p>
        <p class="description">
            <label for="<?php echo $this->get_field_id('parallax') ?>">
                <?php _e( 'Enable Parallax Background', 'artcore');?><br>
                <em><?php _e( 'NOTE: This setting must be setup in both Section Start and Section End blocks.', 'artcore');?></em>
                <?php echo aq_field_checkbox('parallax', $block_id, $parallax) ?>
            </label>
        </p>
                          
        <?php
    }
    
    function block( $instance ) {
        extract( $instance );

        $image          = ( ! empty ( $image ) ) ? 'background-image:url('. $image .');' : '';
        $bg_color       = ( ! empty ( $bg_color ) ) ? 'background-color:'. $bg_color .';' : '';
        $position       = ( ! empty ( $position ) ) ? 'background-position:'. $position .';' : '';
        $repeat         = ( ! empty ( $repeat ) ) ? 'background-repeat:'. $repeat .';': '';
        $padding_bottom = ( ! empty ( $padding_bottom ) ) ? 'padding-bottom:'. (int)$padding_bottom .'px;': 'padding-bottom:0;';
        $padding_top    = ( ! empty ( $padding_top ) ) ? 'padding-top:'. (int)$padding_top .'px;': 'padding-top:0;';  
        $parallax       = ( ! empty ( $parallax ) ) ? 'background-attachment: fixed;': '';
        $layout_mode    = ( ! empty ( $layout_mode )) ? $layout_mode : '';
        
        $style_parallax = ( ! empty( $image ) ) ? sprintf( '%s', $image ) : '';  
        $css_parallax = '';
        
        if ( ! empty( $style_parallax ) ) {          
            $css_parallax = 'style="'. $style_parallax .'" ';
        }
        
        $parallax_wrapper = '';
        
        if ( $parallax == 1 || $parallax == true ) {
            
            $padding_bottom = 'padding-bottom: 0;';
            $padding_top = 'padding-top: 0;';            
            $layout_mode = 'parallax-section';
            $parallax_wrapper = '<div data-stellar-background-ratio="0.5" class="parallax-image" ' . $css_parallax . '></div><div class="parallax-inner">';
        }

        // Shows a section image background if we are not using parallax section
        $section_bg_image = '';
        $section_bg_repeat = '';
        
        if ( $parallax == 0 && $parallax == false ) {                       
            $section_bg_image = $image;
            $section_bg_repeat = $repeat;
            
            if ( $section_bg_image == '' ) {               
                $section_bg_repeat = '';
                
            }
            
        }
         
        // Styles Section        
        $style_wrapper = (
            ! empty( $bg_color ) ||
            ! empty( $section_bg_repeat ) ||
            ! empty( $section_bg_image ) || 
            ! empty( $padding_bottom ) ||
            ! empty( $padding_top ) ) ? 
                sprintf( '%s %s %s %s %s', $bg_color, $section_bg_repeat, $section_bg_image, $padding_bottom, $padding_top ) : '';
       
        $css_wrapper = '';
        if ( ! empty( $style_wrapper ) ) {          
            $css_wrapper= 'style="'. $style_wrapper .'" ';
        }
                     
        //$section_title = str_replace( ' ' , '-', $title);
        if ( !empty( $title ) ) {
            $section_title = sanitize_title( $title );
        }
        
        
        $container_wrapper = '<div class="container"><div class="row">';
        
        
        if (  $layout_mode == 'full-width' ) {                        
            $container_wrapper = '';
        }
             
        echo '<!-- Section Start --><div id="'. esc_attr( $section_title ) . '" class="clearfix ' . esc_attr( $layout_mode ) . '" '. wp_kses_post( $css_wrapper ).' >'
        . wp_kses_stripslashes( $parallax_wrapper ) . wp_kses_post( $container_wrapper );
       
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

aq_register_block( 'PTF_Section_Start_Block' );

endif;