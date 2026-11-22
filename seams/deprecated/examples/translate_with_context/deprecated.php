<?php
// Deprecated in 2.9.0; use _x(). Translates $text like translate(), but assumes that the text contains a context after its last vertical bar. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'translate_with_context', 'Fish & "Chips" <b>here</b>' );
