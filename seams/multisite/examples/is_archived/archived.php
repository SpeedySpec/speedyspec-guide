<?php
// A site's archived flag.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
update_archived( $site, 1 );
return array( is_archived( $site ), is_archived( 1 ) );
