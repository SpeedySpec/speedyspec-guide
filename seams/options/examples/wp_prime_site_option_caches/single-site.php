<?php
// On a single site, network options are options, so this primes the options cache.
add_option( 'guide_x', 'v', '', false );
wp_cache_flush();
wp_prime_site_option_caches( array( 'guide_x' ) );
return wp_cache_get( 'guide_x', 'options' );
