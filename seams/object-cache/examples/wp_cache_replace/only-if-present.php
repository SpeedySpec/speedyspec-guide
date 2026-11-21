<?php
// Replaces a value only when the key is cached.
return array( wp_cache_replace( 'k', 'v' ), wp_cache_set( 'k', 'old' ), wp_cache_replace( 'k', 'new' ), wp_cache_get( 'k' ) );
