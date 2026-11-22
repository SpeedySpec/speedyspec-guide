<?php
// Prints the Custom Fields table of a post's custom fields.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
add_post_meta( $post, 'origin', 'Fujian' );
$html = guide_render( fn() => list_meta( has_meta( $post ) ) );
return array( str_contains( $html, 'id="list-table"' ), str_contains( $html, 'Fujian' ) );
