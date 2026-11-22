<?php
// Unloads a text domain, through override_unload_textdomain, firing unload_textdomain and recording it in $l10n_unloaded so it isn't loaded again just in time.
switch_to_locale( 'fr_FR' );
load_plugin_textdomain( 'guide' );
__( 'Hello', 'guide' );
add_action( 'unload_textdomain', fn( $d, $reload ) => print( "unload_textdomain $d\n" ), 10, 2 );
$ok = unload_textdomain( 'guide' );
return array( $ok, is_textdomain_loaded( 'guide' ), isset( $GLOBALS['l10n_unloaded']['guide'] ), __( 'Hello', 'guide' ) );
