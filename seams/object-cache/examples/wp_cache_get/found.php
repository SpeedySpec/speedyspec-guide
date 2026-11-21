<?php
// A miss is false, like a stored false; $found tells them apart.
wp_cache_set( 'stored_false', false );
wp_cache_get( 'stored_false', '', false, $found_stored );
wp_cache_get( 'missing', '', false, $found_missing );
return array( $found_stored, $found_missing );
