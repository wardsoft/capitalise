<?php
/**
 * Default Search Form Template
 *
 * @package PlugFramework
 * @subpackage Artcore
 */

get_header(); ?>
<div class="search-wrap">
    <form method="get" class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
		<input type="text" placeholder="<?php echo esc_attr__( 'Search here', 'artcore' ); ?>" name="s" autocomplete="off">
	</form>
</div>