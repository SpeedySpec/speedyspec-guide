<?php
// Deletes a post (trashing it first when trash is on and not forced) with its meta, terms, comments and revisions; children move to its parent. Fires before_delete_post, delete_post and deleted_post; the deleted post.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_delete_post( $id );
$trashed = get_post_status( $id );
$deleted = wp_delete_post( $id, true );
return array( $trashed, $deleted->post_title, get_post( $id ) );
