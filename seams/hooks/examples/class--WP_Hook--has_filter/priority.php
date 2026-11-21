<?php
// With a callback, the callback's priority on this hook.
$hook = new WP_Hook();
$hook->add_filter( 'guide', 'trim', 7, 1 );

return array( $hook->has_filter( 'guide', 'trim' ), $hook->has_filter( 'guide', 'strtoupper' ) );
