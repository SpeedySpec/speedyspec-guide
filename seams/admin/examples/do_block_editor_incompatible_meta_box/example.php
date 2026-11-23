<?php
// Prints the message shown in place of a box that isn't compatible with the block editor, with a link to the classic editor when it's active.
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) ) );
$html = guide_render( fn() => do_block_editor_incompatible_meta_box( $post, array( 'id' => 'tasting', 'title' => 'Tasting', 'args' => array( '__back_compat_meta_box' => false, '__block_editor_compatible_meta_box' => false, 'old_callback' => 'guide_tasting_box' ) ) ) );
return str_contains( $html, 'block editor' );
