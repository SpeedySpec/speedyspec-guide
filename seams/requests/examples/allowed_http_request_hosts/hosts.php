<?php
// On http_request_host_is_external, allows the hosts wp_validate_redirect() accepts, such as the site's own; ms_allowed_http_request_hosts() allows the network's sites.
return array( allowed_http_request_hosts( true, 'anything' ), allowed_http_request_hosts( false, 'example.org' ), allowed_http_request_hosts( false, 'other.example' ) );
