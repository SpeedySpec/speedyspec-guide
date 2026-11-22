<?php
// Deprecated in 3.0.0; use taxonomy_exists(). Checks that the taxonomy name exists. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'is_taxonomy', 'category' );
