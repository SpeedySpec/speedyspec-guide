<?php
// On multisite it is stored in the network's sitemeta.
set_site_transient( 'guide_t', 'v' );
global $wpdb;
return $wpdb->get_var( "SELECT meta_value FROM $wpdb->sitemeta WHERE meta_key = '_site_transient_guide_t'" );
