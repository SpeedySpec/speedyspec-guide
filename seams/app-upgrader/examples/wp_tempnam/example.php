<?php
// A unique writable temporary file name in the temp folder, based on a name, created empty.
$file = wp_tempnam( 'plugin.zip' );
$exists = file_exists( $file );
unlink( $file );
return array( $exists, str_ends_with( $file, '.tmp' ), str_starts_with( $file, get_temp_dir() ) );
