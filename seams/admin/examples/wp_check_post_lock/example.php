<?php
// The ID of the user editing a post when someone else holds its lock within the last 150 seconds, or false.
$other = wp_insert_user( array( 'user_login' => 'grace', 'user_email' => 'grace@example.org', 'user_pass' => wp_generate_password() ) );
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$free = wp_check_post_lock( $post );
update_post_meta( $post, '_edit_lock', time() . ':' . $other );
return array( $free, wp_check_post_lock( $post ) === $other );
