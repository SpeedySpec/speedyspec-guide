<?php
// A file's extension, type and a corrected name: images and some other files are checked by their content, and a name whose extension doesn't match is fixed.
$file = tempnam( sys_get_temp_dir(), 'g' );
file_put_contents( $file, base64_decode( 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==' ) );
$checked = wp_check_filetype_and_ext( $file, 'photo.jpg' );
unlink( $file );
return $checked;
