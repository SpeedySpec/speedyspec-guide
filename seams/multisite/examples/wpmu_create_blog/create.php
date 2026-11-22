<?php
// Creates a site on a network with a title, an admin user and options (as site data or options), through wp_insert_site(); an error when it can't.
$id = wpmu_create_blog( 'example.org', '/new/', 'New site', 1, array( 'public' => 0, 'blogdescription' => 'Fresh' ) );
return array( get_blog_option( $id, 'blogname' ), get_blog_option( $id, 'blogdescription' ), get_site( $id )->public, wpmu_create_blog( 'example.org', '/new/', 'Again', 1 )->get_error_code() );
