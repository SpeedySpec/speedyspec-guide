<?php
// Registers the REST routes of the oEmbed provider (oembed/1.0/embed and oembed/1.0/proxy) on rest_api_init.
$GLOBALS['wp_rest_server'] = new WP_REST_Server();
wp_oembed_register_route();
return array_values( array_filter( array_keys( $GLOBALS['wp_rest_server']->get_routes() ), fn( $r ) => str_starts_with( $r, '/oembed' ) ) );
