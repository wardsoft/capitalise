<?php
/**
 * Default 404 Template
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

get_header(); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2><?php _e( 'Nothing Found', 'artcore' ); ?></h2>
                <h4><?php _e( '404 Error', 'artcore' ); ?></h4>
                <p><?php _e( 'The page you are looking for was moved, removed, renamed or might never existed', 'artcore' ); ?></p>
                <a href="<?php echo esc_url( home_url() ); ?>" class="btn btn-accent"><?php _e( 'Return Home', 'artcore' ); ?></a>
            </div>
        </div>      
</section>

<?php get_footer(); ?>