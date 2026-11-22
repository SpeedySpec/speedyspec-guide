<?php
// Registers a route of the Connectors settings page inside wp-admin.
wp_register_options_connectors_wp_admin_route( '/my-plugin', null, 'my-plugin/route' );
$routes = wp_get_options_connectors_wp_admin_routes();
return end( $routes );
