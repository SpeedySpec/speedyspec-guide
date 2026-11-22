<?php
// Deprecated in 4.0.0. Determines if the URL can be accessed over SSL. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'url_is_accessable_via_ssl', 'https://example.org/a?b=1&c=2' );
