<?php
// Basic authentication from a user and password; it needs exactly both, and adds an Authorization header for fsockopen.
$auth = new WpOrg\Requests\Auth\Basic( array( 'user', 'pass' ) );
$out = "GET / HTTP/1.1\r\n";
$auth->fsockopen_header( $out );
try { new WpOrg\Requests\Auth\Basic( array( 'only' ) ); } catch ( WpOrg\Requests\Exception\ArgumentCount $e ) { $err = $e->getMessage(); }
return array( $auth->getAuthString(), $out, $err );
