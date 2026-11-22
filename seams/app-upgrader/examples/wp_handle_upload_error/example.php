<?php
// The default error handler of uploads, defined when an upload is first handled: gives the message as an array.
$tmp = wp_tempnam( 'guide-error.txt' );
$file = array( 'name' => 'guide-error.txt', 'type' => 'text/plain', 'tmp_name' => $tmp, 'error' => UPLOAD_ERR_NO_FILE, 'size' => 0 );
_wp_handle_upload( $file, array( 'test_form' => false ), null, 'wp_handle_sideload' );
unlink( $tmp );
$file = array();
return wp_handle_upload_error( $file, 'The uploaded file is too big.' );
