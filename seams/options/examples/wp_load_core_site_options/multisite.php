<?php
// Primes the network options WordPress reads on most requests.
wp_load_core_site_options();
return wp_cache_get( '1:site_name', 'site-options' );
