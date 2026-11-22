<?php
// A REST request: method, route, headers (names canonicalized), and parameters from the URL, query, body, JSON body, files and defaults; get_param() looks through them in priority order, JSON or body first, then query, URL and defaults.
$request = new WP_REST_Request( 'POST', '/guide/v1/thing' );
$request->set_header( 'Content-Type', 'application/json' );
$request->set_body( '{"color":"red"}' );
$request->set_query_params( array( 'color' => 'blue', 'size' => 'L' ) );
$request->set_default_params( array( 'size' => 'M', 'qty' => 1 ) );
return array( $request->get_param( 'color' ), $request['size'], $request->get_param( 'qty' ), ( fn() => $this->get_parameter_order() )->call( $request ), $request->get_header( 'content_type' ), $request->is_json_content_type() );
