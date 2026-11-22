<?php
// Hooked to heartbeat_received in the editor: renews the user's lock on the post, or says who took it over.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$response = wp_refresh_post_lock( array(), array( 'wp-refresh-post-lock' => array( 'post_id' => $post, 'lock' => '' ) ), 'post' );
return array_keys( $response['wp-refresh-post-lock'] );
