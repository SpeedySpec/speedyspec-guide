<?php
// Moves a comment to the trash, remembering its status; deletes it when trash is off.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_trash_comment( $c );
return array( wp_get_comment_status( $c ), get_comment_meta( $c, '_wp_trash_meta_status', true ) );
