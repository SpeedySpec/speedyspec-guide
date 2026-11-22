<?php
// Hooked to rest_api_init: registers WordPress's own controllers' routes, such as posts, users, settings and block types.
$routes = rest_get_server()->get_routes();
return array( isset( $routes['/wp/v2/posts'] ), isset( $routes['/wp/v2/users/me'] ), isset( $routes['/wp/v2/settings'] ), isset( $routes['/wp/v2/block-types'] ) );
