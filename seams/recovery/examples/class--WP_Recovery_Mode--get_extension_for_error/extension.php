<?php
// The plugin or theme a fatal error came from, by the file's place under WP_PLUGIN_DIR or a theme directory; false for anything else.
$GLOBALS['wp_theme_directories'] = array( '/srv/site/wp-content/themes' );
$mode = new WP_Recovery_Mode();
return array( guide_call( $mode, 'get_extension_for_error', array( 'file' => '/srv/site/wp-content/plugins/broken/inc/a.php' ) ), guide_call( $mode, 'get_extension_for_error', array( 'file' => '/srv/site/wp-content/plugins/single.php' ) ), guide_call( $mode, 'get_extension_for_error', array( 'file' => '/srv/site/wp-content/themes/shiny/functions.php' ) ), guide_call( $mode, 'get_extension_for_error', array( 'file' => '/srv/site/wp-includes/load.php' ) ), guide_call( $mode, 'get_extension_for_error', array() ) );
