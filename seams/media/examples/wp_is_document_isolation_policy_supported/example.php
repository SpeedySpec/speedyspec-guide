<?php
// Whether the browser supports Document-Isolation-Policy: Chromium 137 or later.
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36';
$new = wp_is_document_isolation_policy_supported();
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36';
return array( $new, wp_is_document_isolation_policy_supported() );
