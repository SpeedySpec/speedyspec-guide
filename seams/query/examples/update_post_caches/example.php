<?php
// Caches posts with their terms and meta, for a post type, as WP_Query does.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
add_post_meta( $id, 'k', 'v' );
wp_cache_delete( $id, 'post_meta' );
$posts = array( get_post( $id ) );
update_post_caches( $posts );
return wp_cache_get( $id, 'post_meta' )['k'];
