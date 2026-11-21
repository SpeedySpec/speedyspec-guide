<?php
// Add a callback to this hook at a priority.
$hook = new WP_Hook();
$hook->add_filter( 'guide', 'strtoupper', 20, 1 );

return $hook->has_filter( 'guide', 'strtoupper' );
