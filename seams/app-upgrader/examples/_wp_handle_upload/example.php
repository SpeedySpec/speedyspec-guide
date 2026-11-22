<?php
// Does the work of wp_handle_upload() and wp_handle_sideload(): checks the file, picks a unique name and moves it into the uploads folder.
$tmp = wp_tempnam( 'guide-handle.txt' );
file_put_contents( $tmp, 'Some notes' );
$file = array( 'name' => 'guide-handle.txt', 'type' => 'text/plain', 'tmp_name' => $tmp, 'error' => 0, 'size' => 10 );
$result = _wp_handle_upload( $file, array( 'test_form' => false ), null, 'wp_handle_sideload' );
unlink( $result['file'] );
return array( basename( $result['file'] ), basename( $result['url'] ), $result['type'] );
