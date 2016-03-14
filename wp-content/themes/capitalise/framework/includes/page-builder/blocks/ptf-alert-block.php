<?php
/**
 * Alert Box Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */


if( !class_exists('PTF_Alert_Block') ) :
    
	class PTF_Alert_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => __('Alerts', 'artcore'),
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('PTF_Alert_Block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'content' => '',
				'type' => 'note',
				'style' => ''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$type_options = array(
				'default' => 'Standard',
				'info' => 'Info',
				'note' => 'Notification',
				'warn' => 'Warning',
				'tips' => 'Tips'
			);
			
			?>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e( 'Title (optional)', 'artcore' ); ?><br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('content') ?>">
					<?php _e( 'Alert Text (required)', 'artcore' ); ?>
					<?php echo aq_field_textarea('content', $block_id, $content) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('type') ?>">
					<?php _e( 'Alert Type', 'artcore' ); ?>
					<?php echo aq_field_select('type', $block_id, $type_options, $type) ?>
				</label>
			</p>
			<p class="description half last">
				<label for="<?php echo $this->get_field_id('style') ?>">
					<?php _e( 'Additional inline css styling (optional)', 'artcore' ); ?>
					<?php echo aq_field_input('style', $block_id, $style) ?>
				</label>
			</p>
			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			echo '<div class="aq_alert '. esc_attr( $type ).' cf" style="'. esc_attr( $style ) .'">' . do_shortcode(htmlspecialchars_decode($content)) . '</div>';
			
		}
		
	}
    
    aq_register_block( 'PTF_Alert_Block' );
    
endif;