<?php
// Defines the content URL and the plugin and must-use plugin folders and URLs, unless already defined.
wp_plugin_directory_constants();
return array( WP_CONTENT_URL, WP_PLUGIN_URL, str_replace( ABSPATH, '', WPMU_PLUGIN_DIR ), PLUGINDIR );
