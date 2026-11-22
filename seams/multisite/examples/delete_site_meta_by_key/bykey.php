<?php
// Deletes a meta key from every site.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
add_site_meta( 1, 'color', 'blue' );
add_site_meta( $site, 'color', 'red' );
delete_site_meta_by_key( 'color' );
return array( get_site_meta( 1, 'color' ), get_site_meta( $site, 'color' ) );
