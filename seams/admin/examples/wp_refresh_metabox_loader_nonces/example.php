<?php
// Hooked to heartbeat_received in the block editor: sends fresh nonces for the meta box form.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$response = wp_refresh_metabox_loader_nonces( array(), array( 'wp-refresh-metabox-loader-nonces' => array( 'post_id' => $post ) ) );
return array_keys( $response['wp-refresh-metabox-loader-nonces']['replace'] );
