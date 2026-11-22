<?php
// Preloads the REST data the Connectors settings page inside wp-admin needs.
wp_options_connectors_wp_admin_preload_data();
$script = implode( '', wp_scripts()->get_data( 'wp-api-fetch', 'after' ) );
return str_contains( $script, 'createPreloadingMiddleware' );
