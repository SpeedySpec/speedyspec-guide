<?php
// Whether the request wants JSON back: its Accept or Content-Type is a JSON media type.
$plain = wp_is_json_request();
$_SERVER['HTTP_ACCEPT'] = 'application/json';
return array( $plain, wp_is_json_request() );
