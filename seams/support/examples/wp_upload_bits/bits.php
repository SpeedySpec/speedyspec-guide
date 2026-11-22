<?php
// Writes data to a new file in the uploads folder, under a unique name: its path, URL and type, or an error (such as a type not allowed).
add_filter( 'upload_dir', function ( $dir ) { $dir['path'] = sys_get_temp_dir() . '/guide-bits-' . getmypid(); return $dir; } );
$file = wp_upload_bits( 'note.txt', null, 'hello' );
$content = file_get_contents( $file['file'] );
unlink( $file['file'] ); rmdir( dirname( $file['file'] ) );
return array( basename( $file['file'] ), $content, $file['type'], $file['error'], wp_upload_bits( 'evil.exe', null, 'x' )['error'] );
