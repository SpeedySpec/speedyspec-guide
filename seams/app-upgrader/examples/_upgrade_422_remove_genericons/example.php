<?php
// Removes the Genericons example.html files from themes and plugins during a core update.
wp_mkdir_p( WP_PLUGIN_DIR . '/guide-icons/genericons' );
file_put_contents( WP_PLUGIN_DIR . '/guide-icons/genericons/example.html', '<title>Genericons</title>' );
WP_Filesystem();
_upgrade_422_remove_genericons();
$removed = ! file_exists( WP_PLUGIN_DIR . '/guide-icons/genericons/example.html' );
$GLOBALS['wp_filesystem']->delete( WP_PLUGIN_DIR . '/guide-icons', true );
return $removed;
