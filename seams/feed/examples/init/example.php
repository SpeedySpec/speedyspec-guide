<?php
// Defines MagpieRSS's settings constants (cache on, cache age, fetch timeout, user agent) unless they are set already. Part of the MagpieRSS library, deprecated since 3.0.
require_once ABSPATH . WPINC . '/rss.php';
init();
return array( MAGPIE_CACHE_ON, MAGPIE_CACHE_AGE, MAGPIE_FETCH_TIME_OUT );
