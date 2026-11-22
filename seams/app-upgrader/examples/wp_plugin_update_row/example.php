<?php
// Prints the plugins list row telling that a plugin has a new version, with the details and update links.
set_site_transient( 'update_plugins', (object) array( 'response' => array( 'hello.php' => (object) array( 'slug' => 'hello-dolly', 'new_version' => '1.8', 'url' => 'https://wordpress.org/plugins/hello-dolly/', 'package' => 'https://downloads.wordpress.org/plugin/hello-dolly.1.8.zip' ) ) ) );
$html = guide_render( fn() => wp_plugin_update_row( 'hello.php', array( 'Name' => 'Hello Dolly', 'Version' => '1.7.2' ) ) );
return array( str_contains( $html, 'plugin-update-tr' ), str_contains( $html, 'version 1.8' ) );
