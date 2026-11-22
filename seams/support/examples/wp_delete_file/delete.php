<?php
// Deletes a file; wp_delete_file filters the path, and an empty path deletes nothing.
$file = tempnam( sys_get_temp_dir(), 'g' );
$deleted = wp_delete_file( $file );
return array( $deleted, file_exists( $file ) );
