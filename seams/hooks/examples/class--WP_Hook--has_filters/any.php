<?php
// Whether the hook has any callbacks.
$hook  = new WP_Hook();
$empty = $hook->has_filters();
$hook->add_filter( 'guide', 'trim', 10, 1 );

return array( $empty, $hook->has_filters() );
