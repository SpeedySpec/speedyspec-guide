<?php
// Prints a link to the previous page of comments.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
update_option( 'page_comments', 1 );
update_option( 'comments_per_page', 2 );
for ( $i = 0; $i < 5; $i++ ) {
	wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => "C$i", 'comment_approved' => 1 ) );
}
guide_go( "/?p=$id&cpage=2" );
the_post();
return guide_render( fn() => previous_comments_link( 'Back' ) );
