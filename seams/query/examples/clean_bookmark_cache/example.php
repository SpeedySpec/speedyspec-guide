<?php
// Clears a link's cache and the get_bookmarks() cache.
$link = wp_insert_link( array( 'link_url' => 'https://wordpress.org', 'link_name' => 'WordPress', 'link_rating' => 8 ) );

get_bookmarks();
clean_bookmark_cache( $link );
return array( wp_cache_get( $link, 'bookmark' ), wp_cache_get( 'get_bookmarks', 'bookmark' ) );
