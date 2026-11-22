<?php
// Hooked to load-plugins.php: adds the update notice row under each plugin with an update in the plugins list.
set_site_transient( 'update_plugins', (object) array( 'response' => array( 'hello.php' => (object) array( 'slug' => 'hello-dolly', 'new_version' => '1.8' ) ) ) );
wp_plugin_update_rows();
return has_action( 'after_plugin_row_hello.php', 'wp_plugin_update_row' );
