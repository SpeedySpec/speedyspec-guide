<?php
// Deletes a meta key from every post.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$b = wp_insert_post( array( 'post_title' => 'B' ) );
add_post_meta( $id, 'temp', 1 );
add_post_meta( $b, 'temp', 2 );
delete_post_meta_by_key( 'temp' );
return array( get_post_meta( $id, 'temp' ), get_post_meta( $b, 'temp' ) );
