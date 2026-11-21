<?php
// Lower priorities run first; at one priority, callbacks run in the order they were added.
add_filter( 'guide_order', fn( $v ) => $v . 'a' );
add_filter( 'guide_order', fn( $v ) => $v . 'b' );
add_filter( 'guide_order', fn( $v ) => $v . 'c', 5 );

return apply_filters( 'guide_order', '' );
