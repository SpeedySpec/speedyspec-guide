<?php
// A meta key's default: '' for single, an empty array otherwise, unless registered or filtered by default_{$meta_type}_metadata.
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
register_meta( 'post', 'mood', array( 'single' => true, 'default' => 'calm' ) );
return array( get_metadata_default( 'post', $post, 'mood', true ), get_metadata_default( 'post', $post, 'mood', false ), get_metadata_default( 'post', $post, 'other', true ), get_metadata_default( 'post', $post, 'other' ) );
