<?php
// Deprecated in 3.4.0; use clean_post_cache(). Will clean the page in the cache. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'clean_page_cache', $f['post'] );
