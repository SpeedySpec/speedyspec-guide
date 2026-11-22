<?php
// Preloads the REST data the full-page Font Library app needs.
wp_font_library_preload_data();
$script = implode( '', wp_scripts()->get_data( 'wp-api-fetch', 'after' ) );
return str_contains( $script, 'createPreloadingMiddleware' );
