<?php
// A filtered value can be anything another callback returned, so check it before relying on it.
function my_plugin_items_per_page() {
	$default = 10;

	/** Filters how many items My Plugin lists per page. */
	$per_page = apply_filters( 'my_plugin_items_per_page', $default );

	return ( is_int( $per_page ) && $per_page >= 1 && $per_page <= 100 ) ? $per_page : $default;
}

function other_plugin_more_items( $per_page ) {
	return 25;
}
function broken_plugin_items( $per_page ) {
	return 'lots';
}

add_filter( 'my_plugin_items_per_page', 'other_plugin_more_items' );
$valid = my_plugin_items_per_page();
add_filter( 'my_plugin_items_per_page', 'broken_plugin_items', 20 );
return array( 'valid value used' => $valid, 'invalid value refused' => my_plugin_items_per_page() );
