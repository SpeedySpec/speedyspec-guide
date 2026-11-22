<?php
// A site's meta for a key (one value or all), or all its meta.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
add_site_meta( $site, 'color', 'blue' );
return array( get_site_meta( $site, 'color', true ), get_site_meta( $site, 'color' ), array_keys( get_site_meta( $site ) ) );
