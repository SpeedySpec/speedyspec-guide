<?php
// Sets one of a site's flags or fields (archived, spam, deleted, mature, public, last_updated), through wp_update_site(); deprecated arguments are ignored.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
update_blog_status( $site, 'spam', 1 );
return get_blog_status( $site, 'spam' );
