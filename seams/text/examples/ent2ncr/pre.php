<?php
// pre_ent2ncr can answer instead: any value but null is returned as it is.
add_filter( 'pre_ent2ncr', fn( $r, $text ) => strtoupper( $text ), 10, 2 );
return ent2ncr( '&copy;' );
