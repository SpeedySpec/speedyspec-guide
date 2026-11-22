<?php
// Deprecated in 2.8.0; use get_term_children(). Retrieve category children list separated before and after the term IDs. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'get_category_children', $f['post'] );
