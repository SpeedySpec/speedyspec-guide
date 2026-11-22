<?php
// Deprecated in 3.9.0. Formerly used to escape strings before inserting into the DB. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'format_to_post', '<p>Some <b>content</b>.</p>' );
