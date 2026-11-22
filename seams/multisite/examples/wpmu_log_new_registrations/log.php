<?php
// Records a new site's registration (email, IP, site, date) in the registration_log table.
$_SERVER['REMOTE_ADDR'] = '10.0.0.1';
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
wpmu_log_new_registrations( $site, 1 );
global $wpdb;
return $wpdb->get_row( "SELECT email, IP, blog_id FROM {$wpdb->registration_log} WHERE blog_id = $site", ARRAY_A );
