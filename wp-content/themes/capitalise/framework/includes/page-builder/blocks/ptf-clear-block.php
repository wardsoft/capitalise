<?php
/**
 * Clear Floats Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */
 
if( ! class_exists( 'PTF_Clear_Block' ) ) :
    
    class PTF_Clear_Block extends AQ_Block {
    	
    	//set and create block
    	function __construct() {
    		$block_options = array(
    			'name' => __('Clear', 'artcore'),
    			'size' => 'span12',
    		);
    		
    		//create the block
    		parent::__construct('aq_clear_block', $block_options);
    	}
    	
    	function form($instance) {
    		
    		$defaults = array(
    			'horizontal_line' => 'none',
    			'line_color' => '#353535',
    			'pattern' => '1',
    			'height' => ''
    		);
    		
    		$line_options = array(
    			'none' => 'None',
    			'single' => 'Single',
    			'double' => 'Double',
    			'image' => 'Use Image',
    		);
    		
    		$instance = wp_parse_args($instance, $defaults);
    		extract($instance);
    		
    		$line_color = isset($line_color) ? $line_color : '#353535';
    		
    		?>
    		<p class="description note">
    			<?php _e('Use this block to clear the floats between two or more separate blocks vertically.', 'artcore') ?>
    		</p>
    		<p class="description fourth">
    			<label for="<?php echo $this->get_field_id('line_color') ?>">
    				<?php _e( 'Pick a horizontal line', 'artcore' ); ?><br/>
    				<?php echo aq_field_select('horizontal_line', $block_id, $line_options, $horizontal_line, $block_id); ?>
    			</label>
    		</p>
    		<div class="description fourth">
    			<label for="<?php echo $this->get_field_id('height') ?>">
    				<?php _e( 'Height (optional)', 'artcore' ); ?><br/>
    				<?php echo aq_field_input('height', $block_id, $height, 'min', 'number') ?> px
    			</label>
    		</div>
    		<div class="description half last">
    			<label for="<?php echo $this->get_field_id('line_color') ?>">
    				<?php _e( 'Pick a line color', 'artcore' ); ?><br/>
    				<?php echo aq_field_color_picker('line_color', $block_id, $line_color, $defaults['line_color']) ?>
    			</label>
    			
    		</div>
    		<?php
    		
    	}
    	
    	function block($instance) {
    		extract($instance);
    		
    		switch( $horizontal_line ) {
    			case 'none':
    				break;
    			case 'single':
    				echo '<hr class="aq-block-clear aq-block-hr-single" style="background:'.esc_attr( $line_color ).';"/>';
    				break;
    			case 'double':
    				echo '<hr class="aq-block-clear aq-block-hr-double" style="background:'.esc_attr( $line_color ).';"/>';
    				echo '<hr class="aq-block-clear aq-block-hr-single" style="background:'.esc_attr( $line_color).';"/>';
    				break;
    			case 'image':
    				echo '<hr class="aq-block-clear aq-block-hr-image cf"/>';
    				break;
    		}
    		
    		if( $height ) {
    			echo '<div class="cf" style="height:'.esc_attr($height).'px"></div>';
    		}
    		
    	}
    	
    }

    aq_register_block( 'PTF_Clear_Block' );
    
endif;