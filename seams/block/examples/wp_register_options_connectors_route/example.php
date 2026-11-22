<?php
// Registers a route of the full-page Connectors settings app.
wp_register_options_connectors_route( '/my-plugin', 'my-plugin/content' );
$routes = wp_get_options_connectors_routes();
return end( $routes );
