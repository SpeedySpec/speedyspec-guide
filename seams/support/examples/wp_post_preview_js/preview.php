<?php
// Prints the script that makes a post preview window replace the one before it, named after the post; only on previews.
$GLOBALS['post'] = get_post( wp_insert_post( array( 'post_title' => 'Draft' ) ) );
$plain = guide_render( 'wp_post_preview_js' );
set_query_var( 'preview', true );
$GLOBALS['wp_query']->is_preview = true;
return array( $plain, str_contains( guide_render( 'wp_post_preview_js' ), 'wp-preview-' ) );
