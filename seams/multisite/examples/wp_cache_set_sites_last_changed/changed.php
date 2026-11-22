<?php
// Marks the sites cache group as changed, so site queries run again.
$before = wp_cache_get_last_changed( 'sites' );
wp_cache_set_sites_last_changed();
return wp_cache_get_last_changed( 'sites' ) !== $before;
