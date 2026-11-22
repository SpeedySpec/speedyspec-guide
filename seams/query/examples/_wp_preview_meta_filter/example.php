<?php
// Hooked to get_post_metadata during a preview: gives the autosave's revisioned meta for the previewed post.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );

$GLOBALS['post'] = get_post( $id );
return _wp_preview_meta_filter( 'saved', $id, 'guide_note', true );
