<?php
// A value that isn't numeric counts from 0.
wp_cache_set( 'n', 'text' );
return wp_cache_incr( 'n', 3 );
