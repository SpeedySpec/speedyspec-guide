<?php
// Reads named headers from the first 8 KB of a file (Plugin Name: and the like), with extra headers from extra_{context}_headers.
$file = tempnam( sys_get_temp_dir(), 'g' );
file_put_contents( $file, "<?php\n/*\n * Plugin Name: Demo\n * Version: 1.2\n */" );
$data = get_file_data( $file, array( 'Name' => 'Plugin Name', 'Version' => 'Version', 'Author' => 'Author' ) );
unlink( $file );
return $data;
