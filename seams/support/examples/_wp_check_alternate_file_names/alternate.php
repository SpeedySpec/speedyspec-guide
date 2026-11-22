<?php
// Whether any of the names exists in a folder (which ends in a slash), or clashes with a listed file's image size suffix.
$dir = sys_get_temp_dir() . '/guide-alt-' . getmypid() . '/';
wp_mkdir_p( $dir );
touch( "{$dir}photo.jpg" );
$found = array( _wp_check_alternate_file_names( array( 'photo.jpg' ), $dir, array() ), _wp_check_alternate_file_names( array( 'other.jpg' ), $dir, array( 'other-150x150.jpg' ) ), _wp_check_alternate_file_names( array( 'new.jpg' ), $dir, array() ) );
unlink( "{$dir}photo.jpg" ); rmdir( $dir );
return $found;
