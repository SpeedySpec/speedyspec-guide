<?php
// Prints the Custom Fields box: the post's fields and the Add New Custom Field form.
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) ) );
add_post_meta( $post->ID, 'origin', 'Fujian' );
return str_contains( guide_render( fn() => post_custom_meta_box( $post ) ), 'Fujian' );
