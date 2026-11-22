<?php
// The path of a single post's template: its custom template, single-{post_type}-{slug}.php, single-{post_type}.php, single.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
$id = wp_insert_post( array( 'post_title' => 'One', 'post_status' => 'publish' ) );
guide_go( "/?p=$id" );
return str_replace( get_theme_root(), '<themes>', get_single_template() );
