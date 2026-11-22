<?php
// Prints numbered page links of the listing.
for ( $i = 1; $i <= 25; $i++ ) {
	wp_insert_post( array( 'post_title' => "Post $i", 'post_status' => 'publish', 'post_date' => sprintf( '2026-01-%02d 00:00:00', $i ) ) );
}
guide_go( '/' );
return str_contains( guide_render( 'the_posts_pagination' ), 'pagination' );
