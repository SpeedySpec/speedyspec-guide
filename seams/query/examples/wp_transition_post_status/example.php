<?php
// Fires a post's status change hooks: transition_post_status, {$old}_to_{$new}, and {$new}_{$post_type}.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_transition_post_status( 'private', 'publish', get_post( $id ) );
return array( did_action( 'publish_to_private' ), did_action( 'private_post' ) );
