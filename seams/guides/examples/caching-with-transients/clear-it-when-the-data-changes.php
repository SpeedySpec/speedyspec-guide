<?php
// Delete the transient when what it was worked out from changes, so nobody waits hours for a correct count.
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

function my_plugin_forget_book_count() {
	delete_transient( 'my_plugin_book_count' );
}
add_action( 'save_post_post', 'my_plugin_forget_book_count' );
add_action( 'deleted_post', 'my_plugin_forget_book_count' );

delete_transient( 'my_plugin_book_count' );
wp_insert_post( array( 'post_title' => 'A book about books', 'post_status' => 'publish' ) );
$before = my_plugin_book_count();
wp_insert_post( array( 'post_title' => 'Another book', 'post_status' => 'publish' ) );
return array( 'before' => $before, 'after a new post' => my_plugin_book_count(), 'worked out' => $GLOBALS['guide_slow_runs'] . ' times' );
