<?php
// The address the request came from (_wp_http_referer, else the Referer header) when it is a safe redirect and not the current address; false otherwise.
$_REQUEST['_wp_http_referer'] = '/wp-admin/edit.php';
$_SERVER['REQUEST_URI'] = '/wp-admin/post.php';
$own = wp_get_referer();
$_REQUEST['_wp_http_referer'] = 'https://evil.example/';
return array( $own, wp_get_referer() );
