<?php
// Deprecated in 6.2.0; use WP_Query. Retrieves a page given its title. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
$r = guide_deprecated( 'get_page_by_title', 'About' );
return array( $r[0]->ID === $f['page'], $r[1] );
