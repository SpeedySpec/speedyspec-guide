<?php
// Primes the options registered in a settings group.
global $new_allowed_options;
$new_allowed_options['guide'] = array( 'guide_x' );
add_option( 'guide_x', 'v', '', false );
wp_cache_flush();
wp_prime_option_caches_by_group( 'guide' );
return wp_cache_get( 'guide_x', 'options' );
