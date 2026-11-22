<?php
// Copies the default theme's files into a new theme folder for the old site theme upgrade.
$dir = WP_CONTENT_DIR . '/themes/guide-from-default';
wp_mkdir_p( $dir );
$result = make_site_theme_from_default( 'Guide From Default', 'guide-from-default' );
$header = file_exists( "$dir/style.css" ) ? get_file_data( "$dir/style.css", array( 'name' => 'Theme Name' ) )['name'] : null;
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( $dir, true );
return array( $result, $header );
