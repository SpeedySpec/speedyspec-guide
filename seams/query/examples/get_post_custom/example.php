<?php
// Every meta key of a post with its values; the global post's when empty.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
add_post_meta( $id, 'a', '1' );
add_post_meta( $id, 'a', '2' );
return get_post_custom( $id )['a'];
