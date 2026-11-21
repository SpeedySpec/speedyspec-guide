<?php
// Deprecated in 6.7.0; a bypass already set is returned as it is.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f $v\n" ), 10, 3 );
return ( new WP_Sitemaps() )->redirect_sitemapxml( true, null );
