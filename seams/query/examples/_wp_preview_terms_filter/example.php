<?php
// Hooked to get_the_terms during a preview: gives the autosave's terms for the previewed post.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );

$GLOBALS['wp_query'] = new WP_Query();
return _wp_preview_terms_filter( array( 'saved terms' ), $id, 'category' );
