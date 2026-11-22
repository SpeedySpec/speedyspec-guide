<?php
// Adds a theme template file's title and post types from the theme's theme.json customTemplates.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$info = _add_block_template_info( array( 'slug' => 'page-no-title' ) );
return array( $info['title'], $info['postTypes'] );
