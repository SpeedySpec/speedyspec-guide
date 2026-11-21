<?php
// Remove every callback, or only those at one priority.
$hook = new WP_Hook();
$hook->add_filter( 'guide', 'trim', 5, 1 );
$hook->add_filter( 'guide', 'strtoupper', 10, 1 );
$hook->remove_all_filters( 5 );

return array( $hook->has_filter( 'guide', 'trim' ), $hook->has_filter( 'guide', 'strtoupper' ) );
