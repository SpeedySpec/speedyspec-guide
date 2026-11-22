<?php
// How many sites a network has: all, public, archived, mature, spam and deleted.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
update_archived( $site, 1 );
return wp_count_sites();
