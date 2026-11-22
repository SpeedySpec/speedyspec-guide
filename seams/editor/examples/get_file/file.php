<?php
// Reads a file's contents, or false when it isn't a file; declared in the old wp-tinymce.php loader.
guide_load_functions( 'js/_enqueues/vendor/tinymce/wp-tinymce.php', 'get_file' );
$file = tempnam( sys_get_temp_dir(), 'guide' );
file_put_contents( $file, 'tinymce();' );
$read = get_file( $file );
unlink( $file );
return array( $read, get_file( '/no/such/file' ), get_file( sys_get_temp_dir() ) );
