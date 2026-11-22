<?php
// Whether a site has its tables, checked by its options table; pre_wp_is_site_initialized can answer.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return array( wp_is_site_initialized( $site ), wp_is_site_initialized( 999 ) );
