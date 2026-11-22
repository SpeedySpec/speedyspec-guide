<?php
// Whether the admin and login must use HTTPS; given a value, sets it and gives the old one.
$was = force_ssl_admin( true );
$now = force_ssl_admin();
force_ssl_admin( $was );
return array( $was, $now );
