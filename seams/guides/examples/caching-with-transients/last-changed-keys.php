<?php
// For many cached queries, put a "last changed" value in each key; changing it retires every key at once.
function my_plugin_books_by( $user_id ) {
	$key   = 'books:' . $user_id . ':' . wp_cache_get_last_changed( 'my_plugin_reads' );
	$books = wp_cache_get( $key, 'my_plugin_reads' );
	if ( false === $books ) {
		$books = (array) get_user_meta( $user_id, 'my_plugin_reading_list', true );
		wp_cache_set( $key, $books, 'my_plugin_reads' );
	}
	return $books;
}

function my_plugin_log_read( $user_id, $book ) {
	$books   = (array) get_user_meta( $user_id, 'my_plugin_reading_list', true );
	$books[] = sanitize_text_field( $book );
	update_user_meta( $user_id, 'my_plugin_reading_list', array_values( array_filter( $books ) ) );
	wp_cache_set_last_changed( 'my_plugin_reads' ); // Every cached list is now out of date.
}

update_user_meta( 1, 'my_plugin_reading_list', array( 'Dune' ) );
$before = my_plugin_books_by( 1 );
my_plugin_log_read( 1, 'Emma' );
return array( 'before' => $before, 'after logging a read' => my_plugin_books_by( 1 ) );
