<?php
// Queues sites so their meta loads together when one is first read; only with site meta support.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
wp_lazyload_site_meta( array( $site ) );
return is_site_meta_supported();
