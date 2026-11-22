<?php
// The ID of the object the main query is for, 0 when there is none.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

guide_go( "/?p=$id" );
$single = get_queried_object_id();
guide_go( '/' );
return array( $single === $id, get_queried_object_id() );
