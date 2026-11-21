<?php
// Stores the data with its salt; an array salt is joined with ':'.
wp_cache_set_salted( 'k', 'v', 'posts', array( 'a', 'b' ) );
return wp_cache_get( 'k', 'posts' );
