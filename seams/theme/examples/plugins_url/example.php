<?php
// The plugins URL with a path, relative to a plugin's folder when given a file; filtered by plugins_url.
return array( plugins_url(), plugins_url( 'css/app.css', WP_PLUGIN_DIR . '/my-plugin/my-plugin.php' ) );
