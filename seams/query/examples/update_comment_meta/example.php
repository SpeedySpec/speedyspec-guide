<?php
// Updates a comment's meta value, adding it when missing; a previous value limits the update to rows holding it.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

update_comment_meta( $c, 'mood', 'happy' );
update_comment_meta( $c, 'mood', 'calm', 'happy' );
return get_comment_meta( $c, 'mood', true );
