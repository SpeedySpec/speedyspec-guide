<?php
// Works out the network and site of a request from its domain and path, filling $current_site and $current_blog; a redirect or false when none matches.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
$found = ms_load_current_site_and_network( 'example.org', '/second/hello/' );
return array( $found, $GLOBALS['current_blog']->blog_id, $GLOBALS['current_site']->id );
