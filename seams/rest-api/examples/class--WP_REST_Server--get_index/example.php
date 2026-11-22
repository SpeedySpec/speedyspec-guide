<?php
// The API's index: the site's name, URLs, namespaces, authentication and routes; what GET / gives, filtered by rest_index.
$data = guide_rest( 'GET', '/' )[1];
return array( $data['name'], $data['url'], array_slice( $data['namespaces'], 0, 3 ), isset( $data['routes']['/wp/v2/posts'] ) );
