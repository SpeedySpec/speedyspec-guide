<?php
// Deprecated in 2.9.0. Strip HTML and put links at the bottom of stripped content. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'make_url_footnote', '<p>Some <b>content</b>.</p>' );
