<?php
// Hooked to post_updated: records a published post's old slug in _wp_old_slug, so old links redirect.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_update_post( array( 'ID' => $id, 'post_name' => 'new-slug' ) );
return get_post_meta( $id, '_wp_old_slug' );
