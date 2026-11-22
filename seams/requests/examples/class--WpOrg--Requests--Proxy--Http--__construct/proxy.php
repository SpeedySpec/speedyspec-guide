<?php
// An HTTP proxy from a host, or a host, user and password; fsockopen requests are sent to it with the full URL as the path.
$proxy = new WpOrg\Requests\Proxy\Http( array( 'proxy.example:8080', 'u', 'p' ) );
$socket = 'tcp://example.org:80';
$proxy->fsockopen_remote_socket( $socket );
$path = '/x';
$proxy->fsockopen_remote_host_path( $path, 'http://example.org/x' );
$out = '';
$proxy->fsockopen_header( $out );
try { new WpOrg\Requests\Proxy\Http( array( 'a', 'b' ) ); } catch ( WpOrg\Requests\Exception\ArgumentCount $e ) { $err = $e->getMessage(); }
return array( $socket, $path, $out, $proxy->get_auth_string(), $proxy->use_authentication, $err );
