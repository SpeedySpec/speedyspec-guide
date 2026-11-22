<?php
// Prints the Featured image box.
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) ) );
return str_contains( guide_render( fn() => post_thumbnail_meta_box( $post ) ), 'set-post-thumbnail' );
