<?php
// Unregisters a taxonomy, removing its hooks and query variable; unregistered_taxonomy fires. A built-in taxonomy is refused, with the same error code as a missing one.
register_taxonomy( 'genre', 'post', array( 'label' => 'Genres', 'hierarchical' => true, 'public' => true ) );
add_action( 'unregistered_taxonomy', fn( $t ) => print( "unregistered_taxonomy $t\n" ) );
$done = unregister_taxonomy( 'genre' );
return array( $done, taxonomy_exists( 'genre' ), unregister_taxonomy( 'category' )->get_error_code(), unregister_taxonomy( 'nope' )->get_error_code() );
