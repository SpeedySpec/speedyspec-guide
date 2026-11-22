<?php
// Unzips a file into a folder through $wp_filesystem, with ZipArchive when it can and PclZip otherwise; true or an error.
$dir = get_temp_dir() . 'guide-' . wp_generate_password( 6, false );
wp_mkdir_p( $dir );
$zip_file = "$dir/plugin.zip";
$zip = new ZipArchive();
$zip->open( $zip_file, ZipArchive::CREATE );
$zip->addFromString( 'hello/hello.php', '<?php // Hello' );
$zip->addFromString( 'hello/readme.txt', 'Hi' );
$zip->close();
WP_Filesystem();
$result = unzip_file( $zip_file, "$dir/out" );
$files = array( file_exists( "$dir/out/hello/hello.php" ), file_exists( "$dir/out/hello/readme.txt" ) );
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( $dir, true );
return array( $result, $files );
