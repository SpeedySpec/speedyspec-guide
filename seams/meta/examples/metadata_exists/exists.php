<?php
// Whether an object has a value for a meta key (a registered default doesn't count).
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
add_metadata( 'post', $post, 'flag', '' );
register_meta( 'post', 'mood', array( 'single' => true, 'default' => 'calm' ) );
return array( metadata_exists( 'post', $post, 'flag' ), metadata_exists( 'post', $post, 'mood' ), metadata_exists( 'post', 0, 'flag' ) );
