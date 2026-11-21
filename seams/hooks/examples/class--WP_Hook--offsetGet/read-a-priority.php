<?php
// Reading a priority gives its callbacks, or null.
add_filter( 'guide_o', 'trim', 5 );
$callbacks = $GLOBALS['wp_filter']['guide_o'][5];

return array( count( $callbacks ), $GLOBALS['wp_filter']['guide_o'][99] );
