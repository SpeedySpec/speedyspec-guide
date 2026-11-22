<?php
// Runs the changes WordPress 1.5 made to stored data, for a site whose database is older, including making a theme from the old site's files; upgrade_all() calls it by database version.
update_option( 'blogname', 'Guide Upgrade Theme' );
upgrade_130();
$made = is_dir( WP_CONTENT_DIR . '/themes/guide-upgrade-theme' );
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( WP_CONTENT_DIR . '/themes/guide-upgrade-theme', true );
return $made;
