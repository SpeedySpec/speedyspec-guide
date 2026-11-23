<?php
// Hooked to comment_author in admin comment lists: puts the author's avatar before their name.
$GLOBALS['comment'] = get_comment( wp_insert_comment( array( 'comment_post_ID' => wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) ), 'comment_author_email' => 'ada@example.org', 'comment_content' => 'Hi', 'comment_approved' => 1 ) ) );
return str_contains( floated_admin_avatar( 'Ada' ), 'avatar' );
