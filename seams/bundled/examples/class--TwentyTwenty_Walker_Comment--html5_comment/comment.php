<?php
// Prints a comment in the theme's markup: the avatar and author, a by-post-author mark, the date linked to the comment, the content, the reply and edit links.
guide_theme( 'twentytwenty' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$id = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_author' => 'Ada', 'comment_content' => 'Nice post', 'comment_date' => '2026-03-02 10:00:00', 'comment_approved' => 1 ) );
$html = wp_list_comments( array( 'walker' => new TwentyTwenty_Walker_Comment(), 'echo' => false ), array( get_comment( $id ) ) );
return array( str_contains( $html, 'class="comment-author vcard"' ), str_contains( $html, 'Nice post' ), str_contains( $html, 'March 2, 2026' ) );
