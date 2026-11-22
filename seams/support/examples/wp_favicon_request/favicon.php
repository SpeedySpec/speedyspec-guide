<?php
// For a request for /favicon.ico, sends an empty icon and ends the request; deprecated in 5.4.0, as WordPress serves the site icon instead.
add_action( 'deprecated_function_run', fn( $f, $r ) => print( "$f is deprecated for $r\n" ), 10, 2 );
wp_favicon_request();
return 'not a favicon request';
