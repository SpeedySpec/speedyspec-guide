<?php
// The path of a page's template: its page template, page-{slug}.php, page-{id}.php, page.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
$page = wp_insert_post( array( 'post_title' => 'About', 'post_name' => 'about', 'post_type' => 'page', 'post_status' => 'publish' ) );
guide_go( "/?page_id=$page" );
return str_replace( get_theme_root(), '<themes>', get_page_template() );
