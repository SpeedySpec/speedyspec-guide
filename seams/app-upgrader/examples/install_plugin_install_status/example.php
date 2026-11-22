<?php
// Whether a plugin from the Plugins API can be installed or updated, or is already the newest, with the URL that does it.
$api = array( 'name' => 'Hello Dolly', 'slug' => 'hello-dolly', 'version' => '1.7.2' );
$status = install_plugin_install_status( $api );
return array( $status['status'], str_contains( $status['url'], 'action=install-plugin' ) );
