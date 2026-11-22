<?php
// Prints the classic meta boxes the block editor shows below the content, with their data for the editor's script.
$GLOBALS['post'] = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) ) );
set_current_screen( 'post' );
return str_contains( guide_render( 'the_block_editor_meta_boxes' ), 'metabox-location-normal' );
