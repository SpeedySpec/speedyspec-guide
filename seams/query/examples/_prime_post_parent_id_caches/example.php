<?php
// Loads posts' parent IDs into the cache at once.
$a = wp_insert_post( array( 'post_title' => 'A', 'post_type' => 'page' ) );
$b = wp_insert_post( array( 'post_title' => 'B', 'post_type' => 'page', 'post_parent' => $a ) );
_prime_post_parent_id_caches( array( $b ) );
return wp_cache_get( "post_parent:$b", 'posts' ) === $a;
