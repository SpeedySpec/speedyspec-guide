<?php
// A WP_REST_Request for a request (given back as it is), a route string (a GET to it, the string taken whole as the route) or an array of the request's attributes.
$request = rest_ensure_request( '/wp/v2/posts' );
$attributes = rest_ensure_request( array( 'per_page' => 2 ) );
return array( get_class( $request ), $request->get_route(), $request->get_method(), $attributes->get_attributes() );
