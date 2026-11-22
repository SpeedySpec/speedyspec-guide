<?php
// Deprecated in 3.4.0; use wp_get_themes(). Retrieve list of themes with theme data in theme directory. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
$r = guide_deprecated( 'get_themes' );
return array( array_keys( $r[0] ), $r[1] );
