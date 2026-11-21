<?php
// Remove a callback at a priority; it reports whether it removed one.
$hook = new WP_Hook();
$hook->add_filter( 'guide', 'trim', 10, 1 );

return array( $hook->remove_filter( 'guide', 'trim', 10 ), $hook->has_filters() );
