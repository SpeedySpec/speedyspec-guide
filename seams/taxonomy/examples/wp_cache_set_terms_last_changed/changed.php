<?php
// Marks the terms cache group changed, so cached term queries are stale.
$before = wp_cache_get_last_changed( 'terms' );
wp_cache_set_terms_last_changed();
return $before !== wp_cache_get_last_changed( 'terms' );
