<?php
// Sends pingbacks for every post flagged with _pingme, removing the flag.
$post = wp_insert_post( array( 'post_title' => 'Ping', 'post_status' => 'publish' ) );
add_post_meta( $post, '_pingme', '1' );
do_all_pingbacks();
return get_post_meta( $post, '_pingme' );
