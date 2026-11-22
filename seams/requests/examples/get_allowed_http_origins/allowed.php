<?php
// The http and https forms of the home and admin hosts; allowed_http_origins filters them.
add_filter( 'allowed_http_origins', fn( $o ) => array_merge( $o, array( 'https://app.example' ) ) );
return get_allowed_http_origins();
