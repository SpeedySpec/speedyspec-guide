<?php
// The same key in two groups is two values; an empty group is 'default'.
wp_cache_set( 'k', 'in default' );
wp_cache_set( 'k', 'in posts', 'posts' );
return array( wp_cache_get( 'k', 'default' ), wp_cache_get( 'k', 'posts' ) );
