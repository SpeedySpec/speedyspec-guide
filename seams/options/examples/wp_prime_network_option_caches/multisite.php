<?php
// On multisite, primes the network's options, cached as "<network id>:<name>" in site-options.
wp_prime_network_option_caches( 1, array( 'site_name' ) );
return wp_cache_get( '1:site_name', 'site-options' );
