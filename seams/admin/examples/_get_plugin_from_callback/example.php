<?php
// The plugin a callback's code belongs to, with its header data, found by the plugin's own folder; null for core, themes and single-file plugins in the plugins folder's root.
$dir = WP_PLUGIN_DIR . '/guide-tea';
wp_mkdir_p( $dir );
file_put_contents( "$dir/guide-tea.php", "<?php\n/*\n * Plugin Name: Guide Tea\n */\nfunction guide_tea_callback(): void\n{\n}\n" );
require_once "$dir/guide-tea.php";
wp_clean_plugins_cache( false );
$found = _get_plugin_from_callback( 'guide_tea_callback' );
activate_plugin( 'hello.php' );
$result = array( $found['Name'] ?? null, _get_plugin_from_callback( 'hello_dolly' ), _get_plugin_from_callback( 'wp_dashboard_setup' ) );
unlink( "$dir/guide-tea.php" );
rmdir( $dir );
return $result;
