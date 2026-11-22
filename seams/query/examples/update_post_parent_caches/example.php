<?php
// Loads the parents of posts into the cache at once.
$a = wp_insert_post( array( 'post_title' => 'A', 'post_type' => 'page' ) );
$b = wp_insert_post( array( 'post_title' => 'B', 'post_type' => 'page', 'post_parent' => $a ) );
wp_cache_delete( $a, 'posts' );
update_post_parent_caches( array( get_post( $b ) ) );
return wp_cache_get( $a, 'posts' )->post_title;
