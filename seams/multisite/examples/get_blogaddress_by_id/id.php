<?php
// A site's address by ID, with its scheme; empty for an unknown site.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return array( get_blogaddress_by_id( $site ), get_blogaddress_by_id( 999 ) );
