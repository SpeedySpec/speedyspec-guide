<?php
// Sites matching a WP_Site_Query: IDs, counts or WP_Site objects.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return array( get_sites( array( 'fields' => 'ids' ) ), get_sites( array( 'count' => true ) ), get_sites( array( 'path' => '/second/' ) )[0]->blog_id );
