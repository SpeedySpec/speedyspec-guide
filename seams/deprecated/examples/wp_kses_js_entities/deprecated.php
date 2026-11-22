<?php
// Deprecated in 4.7.0. Removes the HTML JavaScript entities found in early versions of Netscape 4. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_kses_js_entities', '<p>Some <b>content</b>.</p>' );
