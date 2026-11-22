<?php
// Deprecated in 2.8.0; use esc_js(). Escape single quotes, specialchar double quotes, and fix line endings. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'js_escape', 'Fish & "Chips" <b>here</b>' );
