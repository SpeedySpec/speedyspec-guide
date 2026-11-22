<?php
// Changes a site's details, through wp_update_site(); false for an empty update.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
update_blog_details( $site, array( 'public' => 0 ) );
return array( get_site( $site )->public, update_blog_details( $site, array() ) );
