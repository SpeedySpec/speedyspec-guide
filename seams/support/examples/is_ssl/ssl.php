<?php
// Whether the request came over HTTPS: HTTPS on or 1, or port 443.
$plain = is_ssl();
$_SERVER['HTTPS'] = 'on';
$on = is_ssl();
unset( $_SERVER['HTTPS'] );
$_SERVER['SERVER_PORT'] = '443';
return array( $plain, $on, is_ssl() );
