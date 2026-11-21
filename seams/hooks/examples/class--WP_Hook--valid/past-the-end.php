<?php
// Whether the iteration is still on a priority.
add_filter( 'guide_it', 'trim', 20 );
add_filter( 'guide_it', 'strtoupper', 5 );
$hook = $GLOBALS['wp_filter']['guide_it'];
$hook->rewind();
$hook->next();
$hook->next();

return $hook->valid();
