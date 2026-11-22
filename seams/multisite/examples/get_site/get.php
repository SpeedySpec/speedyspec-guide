<?php
// A site's WP_Site by ID or object (the current one by default), or null; get_site filters it.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return array( get_site()->blog_id, get_site( $site )->path, get_site( 999 ) );
