<?php
// Prints the Add New Custom Field form, with a select of the keys already in use.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
add_post_meta( $post, 'origin', 'Fujian' );
$html = guide_render( fn() => meta_form( get_post( $post ) ) );
return array( str_contains( $html, 'id="newmeta"' ), str_contains( $html, '>origin<' ) );
