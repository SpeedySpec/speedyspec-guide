<?php
// Moves a post to the trash, remembering its status and time, trashing its comments; deletes it when trash is off. Fires wp_trash_post and trashed_post.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_trash_post( $id );
return array( get_post_status( $id ), get_post_meta( $id, '_wp_trash_meta_status', true ), did_action( 'trashed_post' ) );
