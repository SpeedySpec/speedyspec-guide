<?php
// A post's meta values for a key, or a single value; every key with no key given.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
add_post_meta( $id, 'size', 'L' );
return array( get_post_meta( $id, 'size', true ), get_post_meta( $id, 'size' ), get_post_meta( $id, 'nope', true ) );
