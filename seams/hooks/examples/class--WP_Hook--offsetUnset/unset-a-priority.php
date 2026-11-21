<?php
// unset() removes every callback at a priority.
add_filter( 'guide_o', 'trim', 5 );
unset( $GLOBALS['wp_filter']['guide_o'][5] );

return has_filter( 'guide_o', 'trim' );
