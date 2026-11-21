<?php
// Before: putting a plain array into $wp_filter; WordPress fails at the next add_filter() on that hook.
$GLOBALS['wp_filter']['guide_p'] = array();
add_filter( 'guide_p', 'trim' );

return 1;
