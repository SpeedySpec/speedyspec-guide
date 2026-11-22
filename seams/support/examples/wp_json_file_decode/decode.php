<?php
// A JSON file's contents decoded (as arrays when asked), or null when it is missing or invalid, with a doing-it-wrong notice.
$file = tempnam( sys_get_temp_dir(), 'g' );
file_put_contents( $file, '{"a":{"b":1}}' );
$decoded = array( wp_json_file_decode( $file, array( 'associative' => true ) ), wp_json_file_decode( $file )->a->b, wp_json_file_decode( '/nonexistent.json' ) );
unlink( $file );
return $decoded;
