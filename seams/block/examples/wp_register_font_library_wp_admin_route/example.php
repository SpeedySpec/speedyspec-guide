<?php
// Registers a route of the Font Library page inside wp-admin.
wp_register_font_library_wp_admin_route( '/my-plugin', null, 'my-plugin/route' );
$routes = wp_get_font_library_wp_admin_routes();
return end( $routes );
