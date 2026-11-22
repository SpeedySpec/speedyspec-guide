<?php
// The _wp_original_http_referer from the request when it is a safe redirect; false otherwise.
$_REQUEST['_wp_original_http_referer'] = 'http://example.org/wp-admin/';
return wp_get_original_referer();
