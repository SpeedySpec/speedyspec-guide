<?php
// Stores a value, replacing any value already cached under the key.
wp_cache_set( 'k', 'old' );
wp_cache_set( 'k', 'new' );
return wp_cache_get( 'k' );
