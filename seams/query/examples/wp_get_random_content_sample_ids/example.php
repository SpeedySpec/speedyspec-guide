<?php
// Up to 50 distinct random IDs between 1 and the highest post ID (cached ten minutes), all of them when there are no more; posts with them may not exist.
for ( $i = 0; $i < 5; $i++ ) {
	wp_insert_post( array( 'post_title' => "P$i", 'post_status' => 'publish' ) );
}
$ids = wp_get_random_content_sample_ids();
sort( $ids );
return $ids;
