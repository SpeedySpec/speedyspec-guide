<?php
// Adds site meta (unique when asked); false without site meta support.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return array( (bool) add_site_meta( $site, 'color', 'blue' ), add_site_meta( $site, 'color', 'red', true ), get_site_meta( $site, 'color', true ) );
