<?php
// Prints the Discussion box: whether to allow comments, trackbacks and pingbacks.
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) ) );
$html = guide_render( fn() => post_comment_status_meta_box( $post ) );
return array( str_contains( $html, 'name="comment_status"' ), str_contains( $html, 'name="ping_status"' ) );
