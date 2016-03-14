<?php
/**
 * Google Map Block
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

if( ! class_exists( 'PTF_Map_Block' ) ) :

class PTF_Map_Block extends AQ_Block {

    function __construct() {
        
        $block_options = array(
            'name'      => __( 'Google Map', 'artcore' ),
            'size'      => 'span12'
        );      
        parent::__construct( 'PTF_Map_Block', $block_options );
        
    }
    
    function form( $instance ){
        
        $defaults = array(
            'map_title'            => '',
            'map_lat'              => '0',
            'map_lon'              => '0',
            'map_zoom'             => '15',
            'map_height'           => '380',
            'map_icon'             => '',           
        );
        
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);
                   
        ?>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('map_title') ?>">
                <?php _e( 'Map Title', 'artcore');?><br>
                <em><?php _e( 'Enter the map title. Leave it empty to hide this info.', 'artcore');?></em>
                <?php echo aq_field_input( 'map_title', $block_id, $map_title ); ?>
            </label>
        </p>
        
        <p class="description half">
            <label for="<?php echo $this->get_field_id('map_lat') ?>">
                <?php _e( 'Map Latitude', 'artcore');?><br>
                <em><?php _e( 'Enter the map latitude. Example: 59.32522.', 'artcore');?></em>
                <?php echo aq_field_input( 'map_lat', $block_id, $map_lat ); ?>
            </label>
        </p>
        
        <p class="description half last">
            <label for="<?php echo $this->get_field_id('map_lon') ?>">
                <?php _e( 'Map Longitude', 'artcore');?><br>
                <em><?php _e( 'Enter the map longitude. Example: 18.07002.', 'artcore');?></em>
                <?php echo aq_field_input( 'map_lon', $block_id, $map_lon ); ?>
            </label>
        </p>
        
        <p class="description half">
            <label for="<?php echo $this->get_field_id( 'map_zoom' ) ?>">
                <?php _e( 'Map Zoom', 'artcore');?>
                <?php echo aq_field_input( 'map_zoom', $block_id, $map_zoom, $size = 'min', $type = 'number' ) ?>
            </label>            
        </p>
        
        <p class="description half last">
            <label for="<?php echo $this->get_field_id( 'map_height' ) ?>">
                <?php _e( 'Map Height', 'artcore');?>
                <?php echo aq_field_input( 'map_height', $block_id, $map_height, $size = 'min', $type = 'number' ) ?>px
            </label>            
        </p>
        
        <p class="description">
            <label for="<?php echo $this->get_field_id('map_icon') ?>">
                <?php _e( 'Map Custom Marker Icon', 'artcore');?><br>
                <em><?php _e( 'This will be used in place of default google map marker icon.', 'artcore');?></em>
                <?php echo aq_field_upload('map_icon', $block_id, $map_icon, $media_type = 'image') ?>
            </label>
        </p>
             
        <?php
    }
    
    function block( $instance ) {
        extract( $instance );
        
        $map_icon   = ( ! empty ( $map_icon )) ? $map_icon : null;
        $map_height = ( ! empty ( $map_height )) ? $map_height : '380';
                              
        // Random ID for Google Map blocks      
        $random_int = rand();
        $map_id = 'map-canvas' . $random_int;

        ?>
        
        <script>
            function initialize() {
                var myLatlng = new google.maps.LatLng(<?php echo wp_json_encode( $map_lat );?>,  <?php echo wp_json_encode( $map_lon );?>);
                var mapOptions = {
                    zoom : <?php echo json_encode( $map_zoom, JSON_NUMERIC_CHECK ); ?>,
                    center : myLatlng,
                    scrollwheel: false,
                    streetViewControl : true
                };
                
                var map = new google.maps.Map(document.getElementById(<?php echo wp_json_encode( $map_id ); ?>), mapOptions);
                
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: <?php echo wp_json_encode( $map_title ); ?>,
                    icon: <?php echo wp_json_encode($map_icon); ?>,
                });
            }
    
            function loadScript() {
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initialize';
                document.body.appendChild(script);
            }
    
            window.onload = loadScript; 
        </script>
        
        <div id="<?php echo esc_attr( $map_id ); ?>" class="contact-map" style="height: <?php echo esc_attr( $map_height );?>px;"></div>

    <?php    
    }
}

aq_register_block( 'PTF_Map_Block' );

endif;