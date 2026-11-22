<?php
// Registers a page's routes from its build manifest with the page's route registering function.
$routes = array( array( 'name' => 'my-plugin-home', 'path' => '/my-plugin', 'has_content' => false, 'has_route' => false ) );
wp_register_page_routes( $routes, 'wp_register_font_library_route' );
$registered = wp_get_font_library_routes();
return end( $registered );
