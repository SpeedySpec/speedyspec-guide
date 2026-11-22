<?php
// A URL with updated=true added, unless it has it; deprecated in 3.3.0 for add_query_arg().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return wpmu_admin_redirect_add_updated_param( 'http://example.org/wp-admin/network/sites.php' );
