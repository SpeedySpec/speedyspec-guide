<?php
// The request's referer as given: _wp_http_referer, else the Referer header; false when neither.
$_SERVER['HTTP_REFERER'] = 'https://anywhere.example/';
return wp_get_raw_referer();
