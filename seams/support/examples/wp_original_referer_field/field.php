<?php
// Prints (or gives) the hidden _wp_original_http_referer field: the original referer, else the current or previous address.
$_SERVER['REQUEST_URI'] = '/wp-admin/edit.php';
return wp_original_referer_field( false );
