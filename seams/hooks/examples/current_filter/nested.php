<?php
// In nested hooks, it names the innermost.
add_filter( 'guide_outer', fn( $v ) => apply_filters( 'guide_inner', $v ) );
add_filter( 'guide_inner', fn( $v ) => current_filter() );

return apply_filters( 'guide_outer', 'v' );
