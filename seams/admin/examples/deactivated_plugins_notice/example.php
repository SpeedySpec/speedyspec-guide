<?php
// Prints the admin notice naming plugins WordPress deactivated because they were incompatible with an update.
update_option( 'wp_force_deactivated_plugins', array( 'gutenberg/gutenberg.php' => array( 'plugin_name' => 'Gutenberg', 'version_deactivated' => '17.0', 'version_compatible' => '17.6' ) ) );
$GLOBALS['pagenow'] = 'index.php';
return str_contains( guide_render( 'deactivated_plugins_notice' ), 'Gutenberg' );
