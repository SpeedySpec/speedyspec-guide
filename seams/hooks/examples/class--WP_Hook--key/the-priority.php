<?php
// The priority the iteration is on.
add_filter( 'guide_it', 'trim', 20 );
add_filter( 'guide_it', 'strtoupper', 5 );
$hook = $GLOBALS['wp_filter']['guide_it'];
$hook->rewind();

return $hook->key();
