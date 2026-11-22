<?php
// Deprecated in 6.0.3; use add_filter( "wp_allow_query_attachment_by_filename", "__return_true" ). Filter the SQL clauses of an attachment query to include filenames. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( '_filter_query_attachment_filenames', array( 'where' => '' ) );
