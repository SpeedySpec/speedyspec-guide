<?php
// Whether the request is a JSONP REST request: a _jsonp parameter that is a valid callback name, with JSONP allowed.
$_GET['_jsonp'] = 'cb';
$valid = wp_is_jsonp_request();
$_GET['_jsonp'] = 'bad name';
return array( $valid, wp_is_jsonp_request() );
