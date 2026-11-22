<?php
// The example.html files of the Genericons icon font found in a folder, at any depth, which a core update removes.
$dir = get_temp_dir() . 'guide-' . wp_generate_password( 6, false );
wp_mkdir_p( "$dir/my-theme/genericons" );
file_put_contents( "$dir/my-theme/genericons/example.html", '<title>Genericons</title>' );
$files = array_map( fn( $f ) => str_replace( "$dir/", '', $f ), _upgrade_422_find_genericons_files_in_folder( $dir ) );
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( $dir, true );
return $files;
