<?php
// 4 for an IPv4 address, 6 for IPv6, false otherwise.
return array( WP_Http::is_ip_address( '192.0.2.1' ), WP_Http::is_ip_address( '2001:db8::1' ), WP_Http::is_ip_address( 'example.org' ) );
