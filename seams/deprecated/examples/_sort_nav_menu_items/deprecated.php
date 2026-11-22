<?php
// Deprecated in 4.7.0; use wp_list_sort(). Sort menu items by the desired key. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( '_sort_nav_menu_items', (object) array( 'term_id' => 1, 'name' => 'b', 'menu_order' => 2 ), (object) array( 'term_id' => 2, 'name' => 'a', 'menu_order' => 1 ) );
