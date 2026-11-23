<?php
// Prints the hidden data Quick Edit reads for a post: its title, slug, date, status, terms and other fields.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_name' => 'tea', 'post_status' => 'publish' ) );
$html = guide_render( fn() => get_inline_data( get_post( $post ) ) );
return array( str_contains( $html, "id=\"inline_$post\"" ), str_contains( $html, '<div class="post_name">tea</div>' ) );
