<?php
// The REST route of the queried post, term or author, or ''; filtered by rest_queried_resource_route.
$id = wp_insert_post( array( 'post_title' => 'Seen', 'post_status' => 'publish' ) );
$none = rest_get_queried_resource_route();
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $id ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
return array( $none, rest_get_queried_resource_route() === "/wp/v2/posts/$id" );
