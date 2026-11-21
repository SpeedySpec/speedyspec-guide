<?php
// isset() on a hook asks whether it has callbacks at a priority.
add_filter( 'guide_o', 'trim', 5 );

return array( isset( $GLOBALS['wp_filter']['guide_o'][5] ), isset( $GLOBALS['wp_filter']['guide_o'][10] ) );
