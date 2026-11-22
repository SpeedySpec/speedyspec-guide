<?php
// Sends Document-Isolation-Policy: isolate-and-credentialless when the browser supports it and headers aren't sent, and notes the request is isolated.
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36';
return array( wp_send_document_isolation_policy_header(), wp_is_cross_origin_isolated_request() );
