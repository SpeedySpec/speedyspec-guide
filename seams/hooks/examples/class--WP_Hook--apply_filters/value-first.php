<?php
// The arguments array holds the value first, then the extra arguments.
$hook = new WP_Hook();
$hook->add_filter( 'guide', fn( $v, $n ) => $v . $n, 10, 2 );

return $hook->apply_filters( 'a', array( 'a', 'b' ) );
