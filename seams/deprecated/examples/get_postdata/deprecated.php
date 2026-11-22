<?php
// Deprecated in 1.5.1; use get_post(). Retrieves all post data for a given post. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'get_postdata', $f['post'] );
