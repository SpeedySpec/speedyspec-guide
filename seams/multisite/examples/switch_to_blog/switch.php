<?php
// Makes another site current: its tables, cache groups, roles and globals, kept on a stack for restore_current_blog(); fires switch_blog.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
function guide_print_switch_blog( $new_blog_id, $old_blog_id, $context ) {
	echo "switch_blog $old_blog_id to $new_blog_id ($context)\n";
}
add_action( 'switch_blog', 'guide_print_switch_blog', 10, 3 );
switch_to_blog( $site );
$inside = array( get_current_blog_id(), get_option( 'blogname' ), $GLOBALS['wpdb']->prefix );
restore_current_blog();
return $inside;
