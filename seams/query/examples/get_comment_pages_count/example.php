<?php
// How many comment pages a post's comments fill with threading and the per-page setting; 1 when paging is off.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );

for ( $i = 0; $i < 5; $i++ ) {
	wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => "C$i", 'comment_approved' => 1 ) );
}
update_option( 'page_comments', 1 );
return array( get_comment_pages_count( get_comments( array( 'post_id' => $post ) ), 2, false ), get_comment_pages_count( get_comments( array( 'post_id' => $post ) ), 10, false ) );
