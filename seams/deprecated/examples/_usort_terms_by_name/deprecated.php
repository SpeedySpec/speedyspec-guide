<?php
// Deprecated in 4.7.0; use wp_list_sort(). Sort categories by name. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( '_usort_terms_by_name', (object) array( 'term_id' => 1, 'name' => 'b', 'menu_order' => 2 ), (object) array( 'term_id' => 2, 'name' => 'a', 'menu_order' => 1 ) );
