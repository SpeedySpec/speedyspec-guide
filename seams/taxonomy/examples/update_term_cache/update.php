<?php
// Caches term objects by ID.
$term = (object) array( 'term_id' => 77, 'name' => 'Cached', 'taxonomy' => 'post_tag' );
update_term_cache( array( $term ) );
return wp_cache_get( 77, 'terms' )->name;
