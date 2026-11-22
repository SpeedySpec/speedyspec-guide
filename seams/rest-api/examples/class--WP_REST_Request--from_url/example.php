<?php
// A GET request for a full URL of this site's REST API, its route and query read from it; false for other URLs.
$request = WP_REST_Request::from_url( rest_url( 'wp/v2/posts' ) . '&per_page=3' );
return array( $request->get_route(), $request->get_query_params(), WP_REST_Request::from_url( 'https://elsewhere.test/wp-json/x' ) );
