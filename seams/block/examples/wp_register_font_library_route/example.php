<?php
// Registers a route of the full-page Font Library app.
wp_register_font_library_route( '/my-plugin', 'my-plugin/content' );
$routes = wp_get_font_library_routes();
return end( $routes );
