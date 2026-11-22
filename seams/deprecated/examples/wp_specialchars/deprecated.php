<?php
// Deprecated in 2.8.0; use esc_html(). Legacy escaping for HTML blocks. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_specialchars', 'Fish & "Chips" <b>here</b>' );
