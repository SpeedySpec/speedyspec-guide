<?php
// Adds a value only when the key isn't cached yet.
return array( wp_cache_add( 'k', 'first' ), wp_cache_add( 'k', 'second' ), wp_cache_get( 'k' ) );
