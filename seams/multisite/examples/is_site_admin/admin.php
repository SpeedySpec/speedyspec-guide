<?php
// Whether a user (by login, the current one by default) is a network super admin; deprecated in 3.0.0 for is_super_admin().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return array( is_site_admin(), is_site_admin( 'admin' ) );
