<?php
// Unloads a text domain, through override_unload_textdomain, firing unload_textdomain and recording it in $l10n_unloaded so it isn't loaded again just in time.
switch_to_locale( 'fr_FR' );
load_plugin_textdomain( 'guide' );
__( 'Hello', 'guide' );
function guide_print_unloaded_textdomain( $domain, $reloadable ) {
	echo "unload_textdomain $domain\n";
}
add_action( 'unload_textdomain', 'guide_print_unloaded_textdomain', 10, 2 );
$ok = unload_textdomain( 'guide' );
return array( $ok, is_textdomain_loaded( 'guide' ), isset( $GLOBALS['l10n_unloaded']['guide'] ), __( 'Hello', 'guide' ) );
