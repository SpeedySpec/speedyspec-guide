<?php
// Moves a file WordPress downloaded into the uploads folder, as wp_handle_upload() does for form uploads, and gives its path, URL and type.
$tmp = wp_tempnam( 'guide-sideload.txt' );
file_put_contents( $tmp, 'Some notes' );
$file = array( 'name' => 'guide-sideload.txt', 'type' => 'text/plain', 'tmp_name' => $tmp, 'error' => 0, 'size' => 10 );
$result = wp_handle_sideload( $file, array( 'test_form' => false ) );
unlink( $result['file'] );
return array( basename( $result['file'] ), basename( $result['url'] ), $result['type'] );
