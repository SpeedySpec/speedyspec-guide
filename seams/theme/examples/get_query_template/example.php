<?php
// The path of the first template found for a type and its candidate names, through locate_template(); filtered by {$type}_template_hierarchy and {$type}_template.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return array( str_replace( get_theme_root(), '<themes>', get_query_template( 'page', array( 'page-about.php', 'page.php' ) ) ), get_query_template( 'nope', array( 'nope.php' ) ) );
