<?php
/**
 * Default Sidebar Template
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

get_header(); ?>

<?php if ( is_active_sidebar( 'ptf-sidebar-widget-area' ) ) : ?>
    <div id="sidebar" class="col-md-4">
    <?php dynamic_sidebar( 'ptf-sidebar-widget-area' ); ?>    
</div>
<?php endif; ?>