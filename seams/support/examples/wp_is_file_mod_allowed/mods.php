<?php
// Whether files may be changed (installs, updates, editing) in a context: not when DISALLOW_FILE_MODS is true; file_mod_allowed filters it.
$plain = wp_is_file_mod_allowed( 'capability_update_core' );
add_filter( 'file_mod_allowed', fn( $allowed, $context ) => 'download_language_pack' !== $context, 10, 2 );
return array( $plain, wp_is_file_mod_allowed( 'download_language_pack' ) );
