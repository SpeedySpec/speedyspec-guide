<?php
// For a query no API covers, use $wpdb with prepare(): every value goes through a placeholder, never into the string.
function my_plugin_titles_like( $search, $limit ) {
	global $wpdb;
	return $wpdb->get_col(
		$wpdb->prepare(
			"SELECT post_title FROM {$wpdb->posts} WHERE post_type = %s AND post_status = %s AND post_title LIKE %s ORDER BY post_title LIMIT %d",
			'post',
			'publish',
			'%' . $wpdb->esc_like( $search ) . '%',
			$limit
		)
	);
}

foreach ( array( 'Dune', 'Dune Messiah', '100% Dune', 'Emma' ) as $title ) {
	wp_insert_post( array( 'post_title' => $title, 'post_status' => 'publish' ) );
}
return array(
	'Dune'       => my_plugin_titles_like( 'Dune', 10 ),
	'hostile'    => my_plugin_titles_like( "' OR 1=1 -- ", 10 ),
	'100%'       => my_plugin_titles_like( '100%', 10 ),
);
