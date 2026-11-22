<?php
// A post's values for one meta key, or null.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
add_post_meta( $id, 'a', '1' );
add_post_meta( $id, 'a', '2' );
return array( get_post_custom_values( 'a', $id ), get_post_custom_values( 'b', $id ) );
