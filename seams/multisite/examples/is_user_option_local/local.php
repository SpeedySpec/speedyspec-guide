<?php
// Whether a user option is set for the current site only; deprecated in 4.9.0.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
update_user_option( 1, 'guide_pref', 'x' );
return is_user_option_local( 'guide_pref', 1 );
