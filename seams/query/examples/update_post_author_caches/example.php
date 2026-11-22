<?php
// Loads the authors of posts into the cache at once.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
update_post_author_caches( array( get_post( $id ) ) );
return is_object( wp_cache_get( 1, 'users' ) );
