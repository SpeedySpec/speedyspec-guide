<?php
// Whether the request is for the login page: the script is wp-login.php (or wp_login_url()'s script).
$plain = is_login();
$_SERVER['SCRIPT_NAME'] = '/wp-login.php';
return array( $plain, is_login() );
