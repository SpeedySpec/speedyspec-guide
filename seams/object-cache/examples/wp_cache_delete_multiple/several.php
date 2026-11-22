<?php
// Deletes several keys; each result says whether that key was deleted.
wp_cache_set( 'a', 1 );
return wp_cache_delete_multiple( array( 'a', 'b' ) );
