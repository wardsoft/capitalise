<?php
/**
 * Skillbar Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */
 
if(!class_exists('PTF_Skillbar_Block')) :

class PTF_Skillbar_Block extends AQ_Block {

    function __construct() {
        $block_options = array(
            'name' => __( 'Skill Bar', 'artcore'),
            'size' => 'span6'
        );
               
        parent::__construct('PTF_Skillbar_Block', $block_options);
        
        //add ajax functions
        add_action('wp_ajax_aq_block_skill_add_new', array($this, 'add_skill'));
        
    }
    
    function form($instance) {
        $defaults = array(
            'skills' => array(
                1 => array(
                    'title'            => __('Add New Skill', 'artcore'),
                    'skill_percentage' => '',                  
                )
            ),
            'column'        => 'three',
            'margin_top'    => 0,
            'margin_bottom' => 0,
        );
        
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);
        
        ?>
        
        <div class="description cf">
            <ul id="aq-sortable-list-<?php echo esc_attr( $block_id ) ?>" class="aq-sortable-list" rel="<?php echo esc_attr( $block_id ) ?>">
                <?php
                $skills = is_array($skills) ? $skills : $defaults['skills'];
                $count = 1;
                foreach($skills as $skill) {    
                    $this->skill($skill, $count);
                    $count++;
                }
                ?>
            </ul>
            <p></p>
            <a href="#" rel="skill" class="aq-sortable-add-new button"><?php _e( 'Add New', 'artcore' ); ?></a>
            <p></p>
        </div>
        <?php
    }
    function skill($skill = array(), $count = 0) {
        
        //global $include_animation ;
        ?>
        <li id="<?php echo $this->get_field_id('skills') ?>-sortable-item-<?php echo esc_attr( $count ) ?>" class="sortable-item" rel="<?php echo esc_attr( $count ) ?>">
            
            <div class="sortable-head cf">
                <div class="sortable-title">
                    <strong><?php echo esc_html( $skill['title'] ) ?></strong>
                </div>
                <div class="sortable-handle">
                    <a href="#"><?php _e('Open / Close', 'artcore' ); ?></a>
                </div>
            </div>
            
            <div class="sortable-body">
                <p class="skill-desc description">
                    <label for="<?php echo $this->get_field_id('skills') ?>-<?php echo esc_attr( $count ) ?>-title">
                        <?php _e('Title', 'artcore' ); ?>
                        <input type="text" id="<?php echo $this->get_field_id('skills') ?>-<?php echo esc_attr( $count ) ?>-title" class="input-full" name="<?php echo $this->get_field_name('skills') ?>[<?php echo esc_attr($count); ?>][title]" value="<?php echo esc_attr($skill['title']); ?>" />
                    </label>
                </p>
                <p class="skill-desc description">
                    <label for="<?php echo $this->get_field_id('skill_percentage') ?>-<?php echo esc_attr( $count ) ?>-skill_percentage">
                        <?php _e('Skill Percentage', 'artcore' ); ?><br>
                        <em><?php _e( 'Enter your skill percentage', 'artcore' ); ?></em>
                        <input type="number" id="<?php echo $this->get_field_id('skills') ?>-<?php echo esc_attr( $count ) ?>-skill_percentage" class="input-min" name="<?php echo $this->get_field_name('skills') ?>[<?php echo esc_attr($count); ?>][skill_percentage]" value="<?php echo esc_attr($skill['skill_percentage']); ?>" />%
                    </label>
                </p>

                <p class="skill-desc description"><a href="#" class="sortable-delete"><?php _e('Delete','artcore' ); ?></a></p>
            </div>
            
        </li>
        <?php
    }
    
    function block($instance) {
        extract($instance);
        $i = 1;
        $output = '';
           
        echo '<div class="progress-wrapper">';
                    
        foreach( $skills as $skill ){                       
            $output .='
                <div class="progress-text">
                    <span class="left">'.$skill['title'].'</span>
                    <span class="right">'.$skill['skill_percentage'].'%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="' . $skill['skill_percentage'] . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $skill['skill_percentage'] . '%"></div>
               </div>';
            $i++;
        }
        
        echo wp_kses_post( $output );
        echo '</div>';
        
    }
    
    /* AJAX add skill */
    function add_skill() {
        $nonce = $_POST['security'];    
        if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
        
        $count = isset($_POST['count']) ? absint($_POST['count']) : false;
        $this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
        
        //default key/value for the skill
        $skill = array(
            'title'     => __('Add New Skill', 'artcore'),
            'skill_percentage' => ''
        );
        
        if($count) {
            $this->skill($skill, $count);
        } else {
            die(-1);
        }
        
        die();
    }
    
    function update($new_instance, $old_instance) {
        $new_instance = aq_recursive_sanitize($new_instance);
        return $new_instance;
    }
     
}

aq_register_block( 'PTF_Skillbar_Block' );

endif;