<?php
// Loads options into the cache in one query, and marks the missing ones in notoptions.
add_option( 'guide_x', 'v', '', false );
wp_cache_flush();
wp_prime_option_caches( array( 'guide_x', 'guide_missing' ) );
$notoptions = wp_cache_get( 'notoptions', 'options' );
return array( wp_cache_get( 'guide_x', 'options' ), isset( $notoptions['guide_missing'] ) );
