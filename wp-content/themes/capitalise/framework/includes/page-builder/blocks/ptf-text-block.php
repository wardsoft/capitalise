<?php
/**
 * Team Member Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

if( ! class_exists( 'PTF_Text_Block' ) ) :

class PTF_Text_Block extends AQ_Block {

    function __construct() {
        $block_options = array(
            'name'      => __( 'Text Box', 'artcore' ),
            'size'      => 'span6'
        );      
        parent::__construct( 'PTF_Text_Block', $block_options );
    }
    
    function form($instance) {
        
        $defaults = array(
            'text'   => '',
            'filter' => 0,
            'class'  => ''
        );
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);
        
        ?>
        <p class="description">
            <label for="<?php echo $this->get_field_id('title') ?>">
                <?php _e( 'Title (Optional)', 'artcore');?>
                <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('class') ?>">
                <?php _e( 'Additional Class (Optional)', 'artcore');?><br>
                <em><?php _e( 'Example: title-heading', 'artcore');?></em>
                <?php echo aq_field_input('class', $block_id, $class, $size = 'full') ?>
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

        $wp_autop = ( isset($wp_autop) ) ? $wp_autop : 0;
        $heading_class = ( !empty($class) ) ? 'class="' . $class .'"' : '';
        
        if($title) echo wp_kses_post( '<h4 '. $heading_class .'>'.strip_tags($title).'</h4>' );
        if($wp_autop == 1){
            echo do_shortcode(htmlspecialchars_decode($text));
        }
        else {
            echo wpautop(do_shortcode(htmlspecialchars_decode($text)));
        }
        
    }
}

aq_register_block( 'PTF_Text_Block' );

endif;