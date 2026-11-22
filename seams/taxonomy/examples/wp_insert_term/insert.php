<?php
// Adds a term to a taxonomy: name, slug (made unique), description and parent; a name already used at that level, an empty name, or a missing parent is refused. create_term, created_term and related actions fire; returns its IDs.
add_action( 'created_category', fn( $id ) => print( "created_category\n" ) );
$a = wp_insert_term( 'Travel', 'category', array( 'description' => 'Trips' ) );
$b = wp_insert_term( 'Travel', 'category', array( 'parent' => $a['term_id'] ) );
return array( array_keys( $a ), get_term( $b['term_id'] )->slug, wp_insert_term( 'Travel', 'category' )->get_error_code(), wp_insert_term( '', 'category' )->get_error_code(), wp_insert_term( 'X', 'category', array( 'parent' => 999 ) )->get_error_code(), wp_insert_term( 'X', 'nope' )->get_error_code() );
