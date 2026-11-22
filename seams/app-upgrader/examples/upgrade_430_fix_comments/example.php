<?php
// Trims comments longer than the comment_content column allows, which WordPress 4.3 found utf8mb4 could leave too long.
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish' ) );
wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Short', 'comment_approved' => 1 ) );
upgrade_430_fix_comments();
return get_comments( array( 'post_id' => $post, 'fields' => 'ids' ) ) !== array();
