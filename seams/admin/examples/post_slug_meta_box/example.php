<?php
// Prints the Slug box's field.
$post = get_post( wp_insert_post( array( 'post_title' => 'Green tea', 'post_status' => 'publish' ) ) );
return str_contains( guide_render( fn() => post_slug_meta_box( $post ) ), 'value="green-tea"' );
