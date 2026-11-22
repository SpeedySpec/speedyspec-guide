<?php
// Makes a theme named after the site from the old site's files or the default theme, during the 1.5 upgrade, and gives its name or false.
update_option( 'blogname', 'Guide Example Theme' );
$theme = make_site_theme();
$made = file_exists( WP_CONTENT_DIR . '/themes/guide-example-theme/style.css' );
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( WP_CONTENT_DIR . '/themes/guide-example-theme', true );
return array( $theme, $made );
