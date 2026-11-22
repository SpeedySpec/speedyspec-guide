<?php
// Registers a taxonomy for object types: a WP_Taxonomy with labels, capabilities, rewrite rules and query variables; names over 32 characters are refused. registered_taxonomy fires after; register_taxonomy_args filters the arguments.
function guide_report_registered_taxonomy( $tax, $types ) {
	echo esc_html( "registered_taxonomy $tax\n" );
}
add_action( 'registered_taxonomy', 'guide_report_registered_taxonomy', 10, 2 );
register_taxonomy( 'genre', 'post', array( 'label' => 'Genres', 'hierarchical' => true, 'public' => true ) );
$tax = get_taxonomy( 'genre' );
return array( $tax->labels->singular_name, $tax->cap->assign_terms, $tax->query_var, $tax->object_type, register_taxonomy( str_repeat( 'x', 33 ), 'post' )->get_error_code() );
