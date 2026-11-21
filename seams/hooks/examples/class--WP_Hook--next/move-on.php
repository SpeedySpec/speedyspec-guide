<?php
// Move the iteration to the next priority.
add_filter( 'guide_it', 'trim', 20 );
add_filter( 'guide_it', 'strtoupper', 5 );
$hook = $GLOBALS['wp_filter']['guide_it'];
$hook->rewind();
$hook->next();

return $hook->key();
