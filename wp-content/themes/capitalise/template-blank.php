<?php
/**Template name: Blank Page
 * Page Builder Template.
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

get_header(); ?>

<?php
    // Slider Section 
    $ptf_slider_content = rwmb_meta( 'ptf_page_slider_shortcode' );
    if ( $ptf_slider_content ) {
        echo '<div class="slider">' . do_shortcode( $ptf_slider_content ) . '</div>';
    }
?>

<?php
    // Content Section
    while ( have_posts() ) : the_post();
        the_content();
    endwhile; 
?>

<?php get_footer(); ?>
