<?php
// Fills in the server variables some servers leave out: REQUEST_URI from PATH_INFO and QUERY_STRING (IIS), SCRIPT_FILENAME, PHP_SELF from REQUEST_URI, and drops HTTPS when it is empty or off.
unset( $_SERVER['REQUEST_URI'] );
$_SERVER['PATH_INFO'] = '/page';
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['QUERY_STRING'] = 'a=1';
$_SERVER['HTTPS'] = 'off';
wp_fix_server_vars();
return array( $_SERVER['REQUEST_URI'], isset( $_SERVER['HTTPS'] ) );
