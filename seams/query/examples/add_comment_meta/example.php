<?php
// Adds a meta value to a comment; unique refuses a second value for the key.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

return array( is_int( add_comment_meta( $c, 'mood', 'happy' ) ), add_comment_meta( $c, 'mood', 'sad', true ), get_comment_meta( $c, 'mood' ) );
