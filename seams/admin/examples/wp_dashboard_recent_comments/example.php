<?php
// Prints the Activity widget's recent comments with their actions; gives whether there were any.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Lovely brew', 'comment_approved' => 1, 'comment_author' => 'Ada' ) );
$found = false;
$html = guide_render( function () use ( &$found ) { $found = wp_dashboard_recent_comments(); } );
return array( $found, str_contains( $html, 'Lovely brew' ) );
