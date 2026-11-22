<?php
// The REST route of a post, from its post type's rest_base; filtered by rest_route_for_post.
$id = wp_insert_post( array( 'post_title' => 'Route', 'post_type' => 'page' ) );
return array( rest_get_route_for_post( $id ), rest_get_route_for_post( 0 ) );
