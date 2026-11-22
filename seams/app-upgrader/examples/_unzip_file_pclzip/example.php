<?php
// Unzips a file with the bundled PclZip into a folder, for servers without ZipArchive; true or an error.
$dir = get_temp_dir() . 'guide-' . wp_generate_password( 6, false );
wp_mkdir_p( $dir );
$zip_file = "$dir/plugin.zip";
$zip = new ZipArchive();
$zip->open( $zip_file, ZipArchive::CREATE );
$zip->addFromString( 'hello/readme.txt', 'Hi' );
$zip->close();
WP_Filesystem();
$result = _unzip_file_pclzip( $zip_file, "$dir/out/", array( "$dir/out", "$dir/out/hello" ) );
$unzipped = file_exists( "$dir/out/hello/readme.txt" );
$GLOBALS['wp_filesystem']->delete( $dir, true );
return array( $result, $unzipped );
