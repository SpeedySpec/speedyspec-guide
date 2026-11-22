<?php
// Unzips a file with ZipArchive into a folder, making the folders it needs; true or an error.
$dir = get_temp_dir() . 'guide-' . wp_generate_password( 6, false );
wp_mkdir_p( $dir );
$zip_file = "$dir/plugin.zip";
$zip = new ZipArchive();
$zip->open( $zip_file, ZipArchive::CREATE );
$zip->addFromString( 'hello/hello.php', '<?php // Hello' );
$zip->close();
WP_Filesystem();
$result = _unzip_file_ziparchive( $zip_file, "$dir/out/", array( "$dir/out", "$dir/out/hello" ) );
$unzipped = file_exists( "$dir/out/hello/hello.php" );
$GLOBALS['wp_filesystem']->delete( $dir, true );
return array( $result, $unzipped );
