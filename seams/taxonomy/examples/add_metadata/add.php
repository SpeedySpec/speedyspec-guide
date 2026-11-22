<?php
// Adds a meta value to an object; with $unique, refused when the key already has a value. Values are stored serialized when needed; add_{$meta_type}_metadata can answer first, and added_{$meta_type}_meta fires with the new meta ID.
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
function guide_report_added_meta( $mid, $id, $key ) {
	echo esc_html( "added_post_meta $key\n" );
}
add_action( 'added_post_meta', 'guide_report_added_meta', 10, 3 );
$first = add_metadata( 'post', $post, 'color', 'red' );
$second = add_metadata( 'post', $post, 'color', array( 'blue' ) );
$unique = add_metadata( 'post', $post, 'color', 'green', true );
return array( is_int( $first ), get_metadata( 'post', $post, 'color' ), $unique, add_metadata( 'post', 0, 'x', 'y' ), add_metadata( 'nope', $post, 'x', 'y' ) );
