<?php
// Prints (or gives) the URL of the next page of the listing.
for ( $i = 1; $i <= 25; $i++ ) {
	wp_insert_post( array( 'post_title' => "Post $i", 'post_status' => 'publish', 'post_date' => sprintf( '2026-01-%02d 00:00:00', $i ) ) );
}
guide_go( '/' );
return next_posts( 0, false );
