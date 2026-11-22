<?php
// Hooked to publish_post: in XML-RPC requests fires xmlrpc_publish_post, and marks the post to ping.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
return has_action( 'publish_post', '_publish_post_hook' );
