<?php
// Deprecated in 3.0.0; use wp_dropdown_categories(). Printed the options of a categories drop-down, now with wp_dropdown_categories().
list( $result, $notice ) = guide_deprecated( 'wp_dropdown_cats' );
return array( $result, substr_count( $notice, '<option' ) );
