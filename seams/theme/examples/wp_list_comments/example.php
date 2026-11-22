<?php
// Prints (or gives) a post's comments as a threaded list through Walker_Comment, paged and styled; filtered by wp_list_comments_args.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_author_url' => 'https://ada.example', 'comment_author_IP' => '10.0.0.1', 'comment_date' => '2026-03-15 10:05:00', 'comment_date_gmt' => '2026-03-15 10:05:00', 'comment_approved' => 1 ) );
$GLOBALS['comment'] = get_comment( $c );
wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Reply', 'comment_approved' => 1, 'comment_parent' => $c ) );
update_option( 'thread_comments', 1 );
guide_go( "/?p=$id" );
the_post();
$html = wp_list_comments( array( 'echo' => false, 'style' => 'ol' ), get_comments( array( 'post_id' => $id ) ) );
return array( substr_count( $html, 'class="comment-body"' ), str_contains( $html, 'class="children"' ) );
