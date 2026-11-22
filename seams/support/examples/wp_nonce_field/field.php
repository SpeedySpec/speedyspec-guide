<?php
// Prints (or gives) a hidden _wpnonce field for an action, and a _wp_http_referer field with the current address unless told not to.
$_SERVER['REQUEST_URI'] = '/wp-admin/options.php';
return preg_replace( '/value="\w{10}"/', 'value="NONCE"', wp_nonce_field( 'save', '_wpnonce', true, false ) );
