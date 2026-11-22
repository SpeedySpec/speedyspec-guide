<?php
// Builds a ZIP of the active block theme with the user's templates, parts and global styles merged in; the file path or an error.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$file = wp_generate_block_templates_export_file();
$zip = new ZipArchive();
$zip->open( $file );
$has = false !== $zip->locateName( 'theme.json' );
$zip->close();
unlink( $file );
return $has;
