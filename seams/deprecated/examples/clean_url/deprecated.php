<?php
// Deprecated in 3.0.0; use esc_url(). Checks and cleans a URL. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'clean_url', 'https://example.org/a?b=1&c=2' );
