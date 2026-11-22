<?php
// The site users without a site were once given, the main site (or the dashboard_blog option's); deprecated in 3.1.0 for get_site().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return get_dashboard_blog()->blog_id;
