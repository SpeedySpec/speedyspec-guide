<?php
// Deprecated in 2.8.0; use esc_attr(). Escaping for HTML attributes. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'attribute_escape', 'Fish & "Chips" <b>here</b>' );
