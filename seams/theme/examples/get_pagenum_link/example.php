<?php
// The URL of a page of the current listing, keeping its query; filtered by get_pagenum_link.
for ( $i = 1; $i <= 25; $i++ ) {
	wp_insert_post( array( 'post_title' => "Post $i", 'post_status' => 'publish', 'post_date' => sprintf( '2026-01-%02d 00:00:00', $i ) ) );
}
guide_go( '/?cat=1' );
return array( get_pagenum_link( 2 ), get_pagenum_link( 1 ) );
