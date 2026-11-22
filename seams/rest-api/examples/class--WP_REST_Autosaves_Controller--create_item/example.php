<?php
// The autosaves controller: a post's autosaves at /<rest_base>/<id>/autosaves; posting saves the user's autosave revision, or for an author's own draft updates the draft itself.
$id = wp_insert_post( array( 'post_title' => 'Live', 'post_status' => 'publish', 'post_content' => 'saved' ) );
[ $status, $autosave ] = guide_rest( 'POST', "/wp/v2/posts/$id/autosaves", array( 'title' => 'Live', 'content' => 'unsaved edit' ) );
return array( $status, $autosave['parent'] === $id, get_post_field( 'post_content', $id ), wp_get_post_autosave( $id )->post_content, count( guide_rest( 'GET', "/wp/v2/posts/$id/autosaves" )[1] ) );
