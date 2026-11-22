<?php
// The files of the active plugins that exist and end in .php, skipping paused plugins during recovery mode.
update_option( 'active_plugins', array( 'hello.php', 'missing/missing.php' ) );
return array_map( fn( $f ) => str_replace( WP_PLUGIN_DIR . '/', '', $f ), wp_get_active_and_valid_plugins() );
