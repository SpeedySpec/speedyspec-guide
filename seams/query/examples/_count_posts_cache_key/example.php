<?php
// The cache key for counting a post type's posts, with readable for the user's own private ones.
return array( _count_posts_cache_key( 'post' ), _count_posts_cache_key( 'page', 'readable' ) === 'posts-page' );
