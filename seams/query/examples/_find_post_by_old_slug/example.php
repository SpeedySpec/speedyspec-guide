<?php
// The ID of a post of a type whose old slug is the queried name, or 0.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

update_post_meta( $id, '_wp_old_slug', 'first-name' );
guide_go( '/?name=first-name' );
return array( _find_post_by_old_slug( 'post' ) === $id, _find_post_by_old_slug( 'page' ) );
