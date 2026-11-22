<?php
// Hooked to wp_after_insert_post: saves a revision when a post is updated, so it holds the post's terms and meta as saved.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );

$before = count( wp_get_post_revisions( $id ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v2', 'post_content' => 'two' ) );
return array( $before, count( wp_get_post_revisions( $id ) ), has_action( 'wp_after_insert_post', 'wp_save_post_revision_on_insert' ) );
