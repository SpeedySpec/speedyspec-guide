<?php
// Whether a file is a ZIP archive ZipArchive or PclZip can open.
$dir = get_temp_dir() . 'guide-' . wp_generate_password( 6, false );
wp_mkdir_p( $dir );
$zip_file = "$dir/plugin.zip";
$zip = new ZipArchive();
$zip->open( $zip_file, ZipArchive::CREATE );
$zip->addFromString( 'hello/hello.php', '<?php // Hello' );
$zip->addFromString( 'hello/readme.txt', 'Hi' );
$zip->close();
file_put_contents( "$dir/broken.zip", 'not a zip' );
$result = array( wp_zip_file_is_valid( $zip_file ), wp_zip_file_is_valid( "$dir/broken.zip" ) );
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( $dir, true );
return $result;
