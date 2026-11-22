<?php
// Did nothing useful (gave false) and is deprecated in 4.4.0.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return get_admin_users_for_domain();
