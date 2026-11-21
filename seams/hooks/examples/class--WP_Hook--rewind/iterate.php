<?php
// foreach over a hook visits its priorities in order (rewind, valid, current, key, next).
add_filter( 'guide_it', 'trim', 20 );
add_filter( 'guide_it', 'strtoupper', 5 );
$hook = $GLOBALS['wp_filter']['guide_it'];
$priorities = array();
foreach ( $hook as $priority => $callbacks ) {
	$priorities[] = $priority;
}

return $priorities;
