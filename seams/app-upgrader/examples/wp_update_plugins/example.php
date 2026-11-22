<?php
// Asks WordPress.org for plugin updates, sending the installed plugins, and stores the answer in the update_plugins transient, at most every 12 hours.
guide_queue_http( array( array( 'plugins' => array( 'hello.php' => array( 'slug' => 'hello-dolly', 'new_version' => '1.8', 'package' => 'https://downloads.wordpress.org/plugin/hello-dolly.1.8.zip' ) ), 'translations' => array(), 'no_update' => array() ) ) );
wp_update_plugins();
return array_keys( get_site_transient( 'update_plugins' )->response );
