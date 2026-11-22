<?php
// Makes another site current: its tables, cache groups, roles and globals, kept on a stack for restore_current_blog(); fires switch_blog.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
add_action( 'switch_blog', fn( $new, $old, $context ) => print( "switch_blog $old to $new ($context)\n" ), 10, 3 );
switch_to_blog( $site );
$inside = array( get_current_blog_id(), get_option( 'blogname' ), $GLOBALS['wpdb']->prefix );
restore_current_blog();
return $inside;
