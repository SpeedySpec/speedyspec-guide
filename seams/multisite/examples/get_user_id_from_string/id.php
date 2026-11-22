<?php
// A user's ID by email or login, or 0; deprecated in 3.6.0 for get_user_by().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return array( get_user_id_from_string( 'admin@example.org' ), get_user_id_from_string( 'admin' ), get_user_id_from_string( 'nobody' ) );
