<?php
// Updates a post's meta value, adding it when missing; a previous value limits the update to rows holding it.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
update_post_meta( $id, 'size', 'S' );
update_post_meta( $id, 'size', 'M', 'nope' );
$kept = get_post_meta( $id, 'size', true );
update_post_meta( $id, 'size', 'M', 'S' );
return array( $kept, get_post_meta( $id, 'size', true ) );
