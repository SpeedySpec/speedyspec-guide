<?php
// The installed plugins that have an update, by file, each with its update data from the update_plugins transient.
set_site_transient( 'update_plugins', (object) array( 'response' => array( 'hello.php' => (object) array( 'slug' => 'hello-dolly', 'new_version' => '1.8', 'package' => 'https://downloads.wordpress.org/plugin/hello-dolly.1.8.zip' ) ) ) );
$updates = get_plugin_updates();
return array( array_keys( $updates ), $updates['hello.php']->update->new_version );
