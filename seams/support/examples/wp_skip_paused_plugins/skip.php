<?php
// Leaves out the plugins paused for recovery mode from a list of plugin files.
return wp_skip_paused_plugins( array( WP_PLUGIN_DIR . '/hello.php' ) ) === array( WP_PLUGIN_DIR . '/hello.php' );
