<?php
// Proxy settings from the WP_PROXY_* constants; requests to the site, localhost and WP_PROXY_BYPASS_HOSTS skip it, and pre_http_send_through_proxy can decide.
$off = new WP_HTTP_Proxy();
$before = $off->is_enabled();
define( 'WP_PROXY_HOST', 'proxy.example' );
define( 'WP_PROXY_PORT', '3128' );
define( 'WP_PROXY_USERNAME', 'u' );
define( 'WP_PROXY_PASSWORD', 'p' );
define( 'WP_PROXY_BYPASS_HOSTS', 'skip.example, *.internal.example' );
$p = new WP_HTTP_Proxy();
return array( $before, $p->is_enabled(), $p->use_authentication(), $p->host(), $p->port(), $p->username(), $p->password(), $p->authentication(), $p->authentication_header(), $p->send_through_proxy( 'http://api.example/' ), $p->send_through_proxy( 'http://example.org/' ), $p->send_through_proxy( 'http://skip.example/' ), $p->send_through_proxy( 'http://a.internal.example/' ), $p->send_through_proxy( 'http://localhost/' ) );
