<?php
// A user's row by login; deprecated in 3.0.0 for get_user_by().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return get_user_details( 'admin' )->user_email;
