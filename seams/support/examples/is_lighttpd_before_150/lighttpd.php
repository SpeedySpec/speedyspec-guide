<?php
// Whether the server is lighttpd older than 1.5.0.
$_SERVER['SERVER_SOFTWARE'] = 'lighttpd/1.4.35';
$old = is_lighttpd_before_150();
$_SERVER['SERVER_SOFTWARE'] = 'nginx/1.25';
return array( $old, is_lighttpd_before_150() );
