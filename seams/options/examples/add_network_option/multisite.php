<?php
// On multisite it inserts a sitemeta row for the network.
add_network_option( 1, 'guide_net', 'v' );
global $wpdb;
return $wpdb->get_var( "SELECT meta_value FROM $wpdb->sitemeta WHERE meta_key = 'guide_net' AND site_id = 1" );
