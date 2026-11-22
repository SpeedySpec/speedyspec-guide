<?php
// A comment's edit screen URL, for users who can edit it; filtered by get_edit_comment_link.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Nice', 'comment_approved' => 1 ) );
return get_edit_comment_link( $c );
