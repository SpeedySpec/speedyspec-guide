<?php
// An exporter returns one page of a person's data at a time, found by email, until it says it is done.
function my_plugin_register_exporter( $exporters ) {
	$exporters['my-plugin-reading-list'] = array(
		'exporter_friendly_name' => __( 'My Plugin reading list', 'my-plugin' ),
		'callback'               => 'my_plugin_export_reading_list',
	);
	return $exporters;
}
add_filter( 'wp_privacy_personal_data_exporters', 'my_plugin_register_exporter' );

function my_plugin_export_reading_list( $email, $page = 1 ) {
	$per_page = 2;
	$user     = get_user_by( 'email', $email );
	$books    = $user ? (array) get_user_meta( $user->ID, 'my_plugin_reading_list', true ) : array();
	$items    = array();
	foreach ( array_slice( $books, ( $page - 1 ) * $per_page, $per_page ) as $i => $book ) {
		$items[] = array(
			'group_id'    => 'my-plugin-reading-list',
			'group_label' => __( 'Reading list', 'my-plugin' ),
			'item_id'     => 'my-plugin-read-' . ( ( $page - 1 ) * $per_page + $i ),
			'data'        => array( array( 'name' => __( 'Book', 'my-plugin' ), 'value' => $book ) ),
		);
	}
	return array( 'data' => $items, 'done' => $page * $per_page >= count( $books ) );
}

// The plugin keeps a reading list and purchase records per person, in user meta.
$reader = wp_insert_user( array( 'user_login' => 'ana', 'user_email' => 'ana@example.org', 'user_pass' => wp_generate_password() ) );
update_user_meta( $reader, 'my_plugin_reading_list', array( 'Dune', 'Emma', 'Ivanhoe' ) );
update_user_meta( $reader, 'my_plugin_purchases', array( 'order 1001' ) );

// What the export tool does: call each registered exporter, page after page, until it is done.
function guide_book_of( $item ) {
	return $item['data'][0]['value'];
}
$exporter = apply_filters( 'wp_privacy_personal_data_exporters', array() )['my-plugin-reading-list'];
$pages    = array();
for ( $page = 1, $done = false; ! $done; $page++ ) {
	$result  = call_user_func( $exporter['callback'], 'ana@example.org', $page );
	$pages[] = array( 'books' => array_map( 'guide_book_of', $result['data'] ), 'done' => $result['done'] );
	$done    = $result['done'];
}
return array( 'name' => $exporter['exporter_friendly_name'], 'pages' => $pages );
