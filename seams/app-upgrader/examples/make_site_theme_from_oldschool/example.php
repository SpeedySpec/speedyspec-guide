<?php
// Makes a theme from the files of a site from before themes, copying index.php and wp-layout.css into a theme folder.
$dir = WP_CONTENT_DIR . '/themes/guide-oldschool';
wp_mkdir_p( $dir );
$result = make_site_theme_from_oldschool( 'Guide Oldschool', 'guide-oldschool' );
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( $dir, true );
return $result;
