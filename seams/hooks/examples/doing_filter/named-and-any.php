<?php
// Without a name, it says whether any hook is running; with one, whether that hook is.
add_filter( 'guide_outer', fn( $v ) => apply_filters( 'guide_inner', $v ) );
add_filter( 'guide_inner', fn( $v ) => var_export( array( doing_filter(), doing_filter( 'guide_outer' ), doing_filter( 'guide_other' ) ), true ) );

return apply_filters( 'guide_outer', 'v' );
