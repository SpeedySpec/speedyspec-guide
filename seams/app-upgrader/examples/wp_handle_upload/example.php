<?php
// Moves a file uploaded through a form into the uploads folder, checking its type, size and errors; gives its path, URL and type, or an error.
$tmp = wp_tempnam( 'guide-upload.txt' );
file_put_contents( $tmp, 'Some notes' );
$file = array( 'name' => 'guide-upload.txt', 'type' => 'text/plain', 'tmp_name' => $tmp, 'error' => 0, 'size' => 10 );
$result = wp_handle_upload( $file, array( 'test_form' => false ) );
unlink( $tmp );
return $result;
