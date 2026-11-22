<?php
// Deletes a site's meta by key, or only rows with a value.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
add_site_meta( $site, 'color', 'blue' );
add_site_meta( $site, 'color', 'red' );
delete_site_meta( $site, 'color', 'blue' );
return get_site_meta( $site, 'color' );
