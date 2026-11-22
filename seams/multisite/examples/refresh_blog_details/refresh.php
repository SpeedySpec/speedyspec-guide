<?php
// Clears a site's cached details and fires refresh_blog_details.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
add_action( 'refresh_blog_details', fn( $id ) => print( "refresh_blog_details $id\n" ) );
refresh_blog_details( $site );
return 'refreshed';
