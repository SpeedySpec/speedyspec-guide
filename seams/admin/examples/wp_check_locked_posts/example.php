<?php
// Hooked to heartbeat_received on posts lists: answers which of the listed posts another user is editing.
$other = wp_insert_user( array( 'user_login' => 'grace', 'user_email' => 'grace@example.org', 'user_pass' => wp_generate_password() ) );
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
update_post_meta( $post, '_edit_lock', time() . ':' . $other );
$response = wp_check_locked_posts( array(), array( 'wp-check-locked-posts' => array( "post-$post" ) ), 'edit-post' );
return array_keys( $response['wp-check-locked-posts'] );
