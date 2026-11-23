<?php
// The object cache keeps values by key and group; without a persistent cache plugin, it lasts only for this request.
function my_plugin_reader_stats( $user_id ) {
	$found = false;
	$stats = wp_cache_get( $user_id, 'my_plugin_stats', false, $found );
	if ( ! $found ) {
		$stats = array( 'books' => count( (array) get_user_meta( $user_id, 'my_plugin_reading_list', true ) ) );
		wp_cache_set( $user_id, $stats, 'my_plugin_stats', HOUR_IN_SECONDS );
	}
	return array( 'stats' => $stats, 'from the cache' => $found );
}

update_user_meta( 1, 'my_plugin_reading_list', array( 'Dune', 'Emma' ) );
$first  = my_plugin_reader_stats( 1 );
$second = my_plugin_reader_stats( 1 );
wp_cache_delete( 1, 'my_plugin_stats' );
return array(
	'first'              => $first,
	'second'             => $second,
	'after delete'       => my_plugin_reader_stats( 1 )['from the cache'],
	'persistent here'    => (bool) wp_using_ext_object_cache(),
);
