<?php
// Pass extra arguments after the value.
add_filter( 'guide_join', fn( $v, $a, $b ) => "$v $a $b", 10, 3 );

return apply_filters( 'guide_join', 'v', '1', '2' );
