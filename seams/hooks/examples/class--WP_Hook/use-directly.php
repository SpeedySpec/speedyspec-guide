<?php
// A hook object on its own, as WordPress keeps one per hook in $wp_filter.
$hook = new WP_Hook();
$hook->add_filter( 'guide', 'strtoupper', 10, 1 );

return $hook->apply_filters( 'hello', array( 'hello' ) );
