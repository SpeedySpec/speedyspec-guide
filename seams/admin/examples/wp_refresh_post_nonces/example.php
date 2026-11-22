<?php
// Hooked to heartbeat_received in the editor: sends fresh nonces for the post form when the old ones are near expiry.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$response = wp_refresh_post_nonces( array(), array( 'wp-refresh-post-nonces' => array( 'post_id' => $post ) ), 'post' );
return array_keys( $response['wp-refresh-post-nonces']['replace'] );
