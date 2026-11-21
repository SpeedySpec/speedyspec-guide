<?php
// The callbacks at the priority the iteration is on.
add_filter( 'guide_it', 'trim', 20 );
add_filter( 'guide_it', 'strtoupper', 5 );
$hook = $GLOBALS['wp_filter']['guide_it'];
$hook->rewind();

return array_keys( $hook->current() );
