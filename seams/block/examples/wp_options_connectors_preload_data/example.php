<?php
// Preloads the REST data the full-page Connectors settings app needs.
wp_options_connectors_preload_data();
$script = implode( '', wp_scripts()->get_data( 'wp-api-fetch', 'after' ) );
return str_contains( $script, 'createPreloadingMiddleware' );
