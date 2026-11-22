<?php
// Unregisters a taxonomy, removing its hooks and query variable; unregistered_taxonomy fires. A built-in taxonomy is refused, with the same error code as a missing one.
register_taxonomy( 'genre', 'post', array( 'label' => 'Genres', 'hierarchical' => true, 'public' => true ) );
function guide_report_unregistered_taxonomy( $taxonomy ) {
	echo "unregistered_taxonomy $taxonomy\n";
}
add_action( 'unregistered_taxonomy', 'guide_report_unregistered_taxonomy' );
$done = unregister_taxonomy( 'genre' );
return array( $done, taxonomy_exists( 'genre' ), unregister_taxonomy( 'category' )->get_error_code(), unregister_taxonomy( 'nope' )->get_error_code() );
