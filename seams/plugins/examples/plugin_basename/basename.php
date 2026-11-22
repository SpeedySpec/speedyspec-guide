<?php
// A plugin file's path relative to the plugins or must-use plugins folder, with forward slashes; a symlinked plugin is resolved through wp_plugin_paths first.
$GLOBALS['wp_plugin_paths'] = array( WP_PLUGIN_DIR . '/linked' => '/srv/shared/linked' );
return array( plugin_basename( WP_PLUGIN_DIR . '/shop/shop.php' ), plugin_basename( WPMU_PLUGIN_DIR . '/cache.php' ), plugin_basename( '/srv/shared/linked/linked.php' ), plugin_basename( WP_PLUGIN_DIR . '/shop\\inc\\a.php' ), plugin_basename( '/elsewhere/x.php' ) );
