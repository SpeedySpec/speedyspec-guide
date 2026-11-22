<?php
// Loads posts' meta into the cache at once.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
add_post_meta( $id, 'k', 'v' );
wp_cache_delete( $id, 'post_meta' );
update_postmeta_cache( array( $id ) );
return wp_cache_get( $id, 'post_meta' )['k'];
