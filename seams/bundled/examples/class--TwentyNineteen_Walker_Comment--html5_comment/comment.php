<?php
// Prints a comment in the theme's markup: avatar (with a mark for the post's author), author, the date linked to the comment, a moderation note, the content, and the edit and reply links.
guide_theme( 'twentynineteen' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$id = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_author' => 'Ada', 'comment_content' => 'Nice post', 'comment_date' => '2026-03-02 10:00:00', 'comment_approved' => 1 ) );
$html = wp_list_comments( array( 'walker' => new TwentyNineteen_Walker_Comment(), 'echo' => false ), array( get_comment( $id ) ) );
return array( str_contains( $html, 'comment-author vcard' ), str_contains( $html, 'Nice post' ), str_contains( $html, 'March 2, 2026' ) );
