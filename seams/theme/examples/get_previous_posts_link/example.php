<?php
// A link to the previous page of the listing, when not on the first; filtered by previous_posts_link_attributes.
for ( $i = 1; $i <= 25; $i++ ) {
	wp_insert_post( array( 'post_title' => "Post $i", 'post_status' => 'publish', 'post_date' => sprintf( '2026-01-%02d 00:00:00', $i ) ) );
}
guide_go( '/?paged=2' );
return get_previous_posts_link( 'Newer' );
