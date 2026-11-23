<?php
// Keep a slow result in a transient for a while; check for false, not for an empty value, before working it out again.
// Something slow to work out: here, counting the books in published posts.
function my_plugin_count_books_slowly() {
	$GLOBALS['guide_slow_runs'] = ( $GLOBALS['guide_slow_runs'] ?? 0 ) + 1;
	return (int) ( new WP_Query( array( 's' => 'book', 'fields' => 'ids', 'posts_per_page' => -1 ) ) )->found_posts;
}

function my_plugin_book_count() {
	$count = get_transient( 'my_plugin_book_count' );
	if ( false === $count ) {
		$count = my_plugin_count_books_slowly();
		set_transient( 'my_plugin_book_count', $count, 12 * HOUR_IN_SECONDS );
	}
	return (int) $count;
}

delete_transient( 'my_plugin_book_count' ); // The example starts without it.
wp_insert_post( array( 'post_title' => 'A book about books', 'post_status' => 'publish' ) );
$first  = my_plugin_book_count();
$second = my_plugin_book_count();
return array(
	'count'                 => array( $first, $second ),
	'worked out'            => $GLOBALS['guide_slow_runs'] . ' time',
	'expires in (hours)'    => (int) round( ( get_option( '_transient_timeout_my_plugin_book_count' ) - time() ) / HOUR_IN_SECONDS ),
);
