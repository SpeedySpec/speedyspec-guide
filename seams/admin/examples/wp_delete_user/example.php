<?php
// Deletes a user from the site, reassigning their posts and links to another user or deleting them; on a network, only removes them from the site.
$user = wp_insert_user( array( 'user_login' => 'grace', 'user_email' => 'grace@example.org', 'user_pass' => wp_generate_password() ) );
$post = wp_insert_post( array( 'post_title' => 'By Grace', 'post_status' => 'publish', 'post_author' => $user ) );
wp_delete_user( $user, 1 );
return array( get_userdata( $user ), (int) get_post_field( 'post_author', $post ) );
