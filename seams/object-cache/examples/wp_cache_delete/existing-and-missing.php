<?php
// Returns whether something was deleted.
wp_cache_set( 'k', 'v' );
return array( wp_cache_delete( 'k' ), wp_cache_delete( 'k' ) );
