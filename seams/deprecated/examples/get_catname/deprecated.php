<?php
// Deprecated in 2.8.0; use get_cat_name(). Retrieve the category name by the category ID. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'get_catname', $f['category'] );
