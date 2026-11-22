<?php
// Undoes a site's setup: drops its tables (wpmu_drop_tables filters them) and deletes its uploads folder; fires wp_uninitialize_site. An error when not initialized.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
$done = wp_uninitialize_site( $site );
return array( $done, wp_is_site_initialized( $site ) );
