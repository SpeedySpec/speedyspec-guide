<?php
// Deletes a post's meta values for a key, or only those matching a value.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
add_post_meta( $id, 'tag', 'a' );
add_post_meta( $id, 'tag', 'b' );
delete_post_meta( $id, 'tag', 'a' );
return get_post_meta( $id, 'tag' );
