<?php
// Deletes a comment's meta values for a key, or only those matching a value.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

add_comment_meta( $c, 'tag', 'a' );
add_comment_meta( $c, 'tag', 'b' );
delete_comment_meta( $c, 'tag', 'a' );
return get_comment_meta( $c, 'tag' );
