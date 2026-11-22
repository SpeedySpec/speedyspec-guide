<?php
// Prints the previous and next page links of the listing.
for ( $i = 1; $i <= 25; $i++ ) {
	wp_insert_post( array( 'post_title' => "Post $i", 'post_status' => 'publish', 'post_date' => sprintf( '2026-01-%02d 00:00:00', $i ) ) );
}
guide_go( '/?paged=2' );
return guide_render( fn() => posts_nav_link( ' | ', 'Newer', 'Older' ) );
