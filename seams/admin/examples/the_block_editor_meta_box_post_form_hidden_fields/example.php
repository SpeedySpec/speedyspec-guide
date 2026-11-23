<?php
// Prints the hidden fields the block editor's meta box form posts with: nonces, IDs and the referer.
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) ) );
$html = guide_render( fn() => the_block_editor_meta_box_post_form_hidden_fields( $post ) );
return array( str_contains( $html, "name='post_ID'" ) || str_contains( $html, 'name="post_ID"' ), str_contains( $html, '_wpnonce' ) );
