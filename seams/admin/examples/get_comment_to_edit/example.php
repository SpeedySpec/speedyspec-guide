<?php
// A comment with its fields escaped for the edit form.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$comment = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_author' => 'Ada & co', 'comment_content' => 'Hi', 'comment_approved' => 1 ) );
return get_comment_to_edit( $comment )->comment_author;
