<?php
// Prints the Excerpt box's textarea.
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft', 'post_excerpt' => 'A short note.' ) ) );
return str_contains( guide_render( fn() => post_excerpt_meta_box( $post ) ), 'A short note.' );
