<?php
// A URL safe to request: http or https, no credentials, a port of 80, 443 or 8080 (http_allowed_safe_ports), and a host that isn't private or loopback (unless it is the site's own).
add_filter( 'http_allowed_safe_ports', fn( $ports ) => array_merge( $ports, array( 8443 ) ) );
return array( wp_http_validate_url( 'http://example.org/x' ), wp_http_validate_url( 'http://93.184.216.34:8443/' ), wp_http_validate_url( 'http://93.184.216.34:22/' ), wp_http_validate_url( 'http://127.0.0.1/' ), wp_http_validate_url( 'javascript:alert(1)' ), wp_http_validate_url( 'http://u:p@93.184.216.34/' ), wp_http_validate_url( 5 ) );
