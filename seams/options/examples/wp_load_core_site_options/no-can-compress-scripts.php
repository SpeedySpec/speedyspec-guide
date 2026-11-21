<?php
// On trunk, can_compress_scripts is no longer one of them.
global $wpdb;
$wpdb->insert( $wpdb->sitemeta, array( 'site_id' => 1, 'meta_key' => 'can_compress_scripts', 'meta_value' => '1' ) );
wp_load_core_site_options();
return wp_cache_get( '1:can_compress_scripts', 'site-options' );
