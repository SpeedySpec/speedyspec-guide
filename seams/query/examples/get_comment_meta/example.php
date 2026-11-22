<?php
// A comment's meta values for a key, or a single value; every key with no key given.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

add_comment_meta( $c, 'rating', '5' );
return array( get_comment_meta( $c, 'rating', true ), get_comment_meta( $c, 'rating' ), array_keys( get_comment_meta( $c ) ) );
