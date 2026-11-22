<?php
// When a preview request carries a valid nonce, hooks _set_preview into the_preview so the autosave shows; wp_die() with a 403 for a bad nonce.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );

$_GET['preview_id'] = $id;
$_GET['preview_nonce'] = wp_create_nonce( 'post_preview_' . $id );
_show_post_preview();
return has_filter( 'the_preview', '_set_preview' );
