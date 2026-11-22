<?php
// Runs a REST request and adds its response to a memo by path, for preloading into the editor (array_reduce() over paths); an OPTIONS path is given as an array.
$id = wp_insert_post( array( 'post_title' => 'Preload', 'post_status' => 'publish' ) );
$memo = array_reduce( array( "/wp/v2/posts/$id?_fields=id,title", array( '/wp/v2/posts', 'OPTIONS' ) ), 'rest_preload_api_request', array() );
return array( array_keys( $memo ), $memo["/wp/v2/posts/$id?_fields=id,title"]['body'] );
