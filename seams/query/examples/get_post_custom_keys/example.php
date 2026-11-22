<?php
// A post's meta keys, or nothing when it has none.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
add_post_meta( $id, 'a', '1' );
add_post_meta( $id, '_hidden', '1' );
return get_post_custom_keys( $id );
