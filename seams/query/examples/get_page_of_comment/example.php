<?php
// The comment page a comment is on, for its post's paging, threading and order; cached.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );

update_option( 'page_comments', 1 );
update_option( 'comments_per_page', 2 );
$ids = array();
for ( $i = 0; $i < 5; $i++ ) {
	$ids[] = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => "C$i", 'comment_approved' => 1, 'comment_date_gmt' => "2026-01-0" . ( $i + 1 ) . " 00:00:00" ) );
}
return array( get_page_of_comment( $ids[0] ), get_page_of_comment( $ids[4] ) );
