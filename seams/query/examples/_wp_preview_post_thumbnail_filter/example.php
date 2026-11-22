<?php
// Hooked to get_post_metadata during a preview: gives the featured image sent with the preview, from _thumbnail_id in the request.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );

$_REQUEST['_thumbnail_id'] = 42;
$_REQUEST['preview_id'] = $id;
$GLOBALS['post'] = get_post( $id );
add_filter( 'is_preview', '__return_true' );
return _wp_preview_post_thumbnail_filter( null, $id, '_thumbnail_id' );
