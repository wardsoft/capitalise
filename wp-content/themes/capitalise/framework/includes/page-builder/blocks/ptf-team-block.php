<?php
/**
 * Team Member Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

if( ! class_exists( 'PTF_Team_Block' ) ) :

class PTF_Team_Block extends AQ_Block {

    function __construct() {
        $block_options = array(
            'name'      => __( 'Team Member', 'artcore' ),
            'size'      => 'span6'
        );      
        parent::__construct( 'PTF_Team_Block', $block_options );
    }
    
    function form( $instance ){
        $defaults = array(
            'member_pic'           => '',
            'member_twitter'       => '#',
            'member_facebook'      => '#',
            'member_instagram'     => '#',
            'member_name'          => '',
            'member_position'      => '',            
            'member_desc'          => ''
        );
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);
                        
        ?>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('member_pic') ?>">
                <?php _e( 'Member Photo', 'artcore');?><br>
                <em><?php _e( 'Minimum size required of 640x640 pixels.', 'artcore');?></em>
                <?php echo aq_field_upload('member_pic', $block_id, $member_pic, $media_type = 'image') ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('member_name') ?>">
                <?php _e( 'Member Name', 'artcore');?>
                <em><?php echo aq_field_input( 'member_name', $block_id, $member_name ); ?></em>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('member_position') ?>">
                <?php _e( 'Member Role', 'artcore');?><br>
                <em><?php _e( 'Example: CEO Founder.', 'artcore');?></em>
                <?php echo aq_field_input( 'member_position', $block_id, $member_position ); ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('member_desc') ?>">
                <?php _e( 'Member Description', 'artcore');?>
                <?php echo aq_field_textarea( 'member_desc', $block_id, $member_desc ); ?>
            </label>
        </p>
        
         <p class="description">
            <label for="<?php echo $this->get_field_id('member_twitter') ?>">
                <?php _e( 'Twitter URL', 'artcore');?><br>
                <em><?php _e( 'Example: http://twitter.com/your_user_name.', 'artcore');?></em>
                <?php echo aq_field_input( 'member_twitter', $block_id, $member_twitter ); ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('member_facebook') ?>">
                <?php _e( 'Facebook URL', 'artcore');?><br>
                <em><?php _e( 'Example: http://facebook.com/your_user_name.', 'artcore');?></em>
                <?php echo aq_field_input( 'member_facebook', $block_id, $member_facebook ); ?>
            </label>
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('member_instagram') ?>">
                <?php _e( 'Instagram URL', 'artcore');?><br>
                <em><?php _e( 'Example: http://instagram.com/your_user_name.', 'artcore');?></em>
                <?php echo aq_field_input( 'member_instagram', $block_id, $member_instagram ); ?>
            </label>
        </p>
 
        <?php
    }
    
    function block( $instance ) {
        extract( $instance );
        
        $member_pic              = ( ! empty ( $member_pic )) ? $member_pic : '';
        $member_name             = ( ! empty ( $member_name )) ? $member_name : '';
        $member_position         = ( ! empty ( $member_position )) ? $member_position : '';
        $member_desc             = ( ! empty ( $member_desc )) ? $member_desc : '';
        $member_twitter          = ( ! empty ( $member_twitter )) ? $member_twitter : '#';
        $member_facebook         = ( ! empty ( $member_facebook )) ? $member_facebook : '#';
        $member_instagram        = ( ! empty ( $member_instagram )) ? $member_instagram : '#';

        ?>
        
        <div class="cf">
        	<div class="team-item">
        		<div class="team-thumb">
        			<img src="<?php echo esc_url( aq_resize( $member_pic , 640, 640, true ) ); ?>" alt="<?php echo esc_attr( $member_name ); ?>">
        			<div class="hover">
        				<a href="<?php echo esc_url( $member_twitter ); ?>"><i class="fa fa-twitter"></i></a>
        				<a href="<?php echo esc_url( $member_facebook ); ?>"><i class="fa fa-facebook"></i></a>
        				<a href="<?php echo esc_url( $member_facebook ); ?>"><i class="fa fa-instagram"></i></a>
        			</div>
        			<div class="overlay"></div>
        		</div>
        		<div class="team-content">
        		    
        		    <?php if ( !empty( $member_position )) : ?>
        			     <span class="role"><?php echo esc_html( $member_position ); ?></span>
        			<?php endif; ?>
        			
        			<?php if ( !empty( $member_name )) : ?>
        			     <h5><?php echo esc_html( $member_name ); ?></h5>
        			<?php endif; ?>
        			
        			<?php if ( !empty( $member_desc )) : ?>
        			     <p><?php echo esc_html( $member_desc ); ?></p>
        			<?php endif; ?>
        			
        		</div>
        	</div>
        </div>

    <?php    
    }
}

aq_register_block( 'PTF_Team_Block' );

endif;