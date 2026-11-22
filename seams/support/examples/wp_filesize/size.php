<?php
// A file's size in bytes, 0 when it doesn't exist; pre_wp_filesize can answer and wp_filesize filters it.
$file = tempnam( sys_get_temp_dir(), 'g' );
file_put_contents( $file, '12345' );
$size = wp_filesize( $file );
unlink( $file );
return array( $size, wp_filesize( '/nonexistent' ) );
