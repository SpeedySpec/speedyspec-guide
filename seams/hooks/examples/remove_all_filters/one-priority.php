<?php
// Remove only the callbacks at one priority.
add_filter( 'guide_x', fn( $v ) => $v . 'a', 5 );
add_filter( 'guide_x', fn( $v ) => $v . 'b' );
remove_all_filters( 'guide_x', 5 );

return apply_filters( 'guide_x', '' );
