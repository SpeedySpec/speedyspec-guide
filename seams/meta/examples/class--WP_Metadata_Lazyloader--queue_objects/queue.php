<?php
// Queues terms or comments for their meta to be loaded together: the first get_term_meta() for any of them loads all; metadata_lazyloader_queued_objects fires.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$sport = wp_insert_term( 'Sport', 'category' );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
add_term_meta( $news['term_id'], 'a', 1 );
add_term_meta( $sport['term_id'], 'b', 2 );
wp_cache_delete( $news['term_id'], 'term_meta' );
wp_cache_delete( $sport['term_id'], 'term_meta' );
function guide_report_queued_objects( $ids, $type ) {
	echo "queued $type\n";
}
add_action( 'metadata_lazyloader_queued_objects', 'guide_report_queued_objects', 10, 2 );
$loader = wp_metadata_lazyloader();
$loader->queue_objects( 'term', array( $news['term_id'], $sport['term_id'] ) );
get_term_meta( $news['term_id'], 'a', true );
return array( wp_cache_get( $sport['term_id'], 'term_meta' ), $loader->queue_objects( 'nope', array( 1 ) )->get_error_code() );
