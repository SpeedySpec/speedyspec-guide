<?php
// Whether this request was made cross-origin isolated by sending Document-Isolation-Policy.
$before = wp_is_cross_origin_isolated_request();
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36';
wp_send_document_isolation_policy_header();
return array( $before, wp_is_cross_origin_isolated_request() );
