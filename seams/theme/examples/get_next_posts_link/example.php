<?php
// A link to the next page of the listing, when there is one; filtered by next_posts_link_attributes.
for ( $i = 1; $i <= 25; $i++ ) {
	wp_insert_post( array( 'post_title' => "Post $i", 'post_status' => 'publish', 'post_date' => sprintf( '2026-01-%02d 00:00:00', $i ) ) );
}
guide_go( '/' );
return get_next_posts_link( 'Older' );
