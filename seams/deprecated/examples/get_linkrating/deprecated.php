<?php
// Deprecated in 2.1.0; use sanitize_bookmark_field(). Legacy function that retrieved the value of a link's link_rating field. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'get_linkrating', (object) array( 'link_rating' => 3 ) );
