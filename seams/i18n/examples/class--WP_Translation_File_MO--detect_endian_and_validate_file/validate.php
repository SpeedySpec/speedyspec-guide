<?php
// A .mo file must start with the magic number in either byte order; otherwise it reports an error.
$file = tempnam( sys_get_temp_dir(), 'mo' ) . '.mo';
file_put_contents( $file, str_repeat( 'x', 40 ) );
$bad = WP_Translation_File::create( $file );
$bad->entries();
unlink( $file );
return $bad->error();
