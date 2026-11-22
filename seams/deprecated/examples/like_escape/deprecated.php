<?php
// Deprecated in 4.0.0; use wpdb::esc_like(). Formerly used to escape strings before searching the DB. It was poorly documented and never worked as described. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'like_escape', 'Fish & "Chips" <b>here</b>' );
