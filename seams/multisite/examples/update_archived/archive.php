<?php
// Sets a site's archived flag; gives the value.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return update_archived( $site, 1 );
