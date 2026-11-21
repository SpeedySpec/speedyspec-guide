<?php
// The registry finds the folder of a text domain's translations for a locale, from custom paths (set_custom_path) and the language files in WP_LANG_DIR; lang_dir_for_domain filters it. has() is true for a domain not yet looked up, so it can be looked up.
$r = $GLOBALS['wp_textdomain_registry'];
$r->set_custom_path( 'guide', WP_PLUGIN_DIR );
add_filter( 'lang_dir_for_domain', fn( $path, $domain, $locale ) => $path, 10, 3 );
return array( str_replace( WP_LANG_DIR, 'WP_LANG_DIR', (string) $r->get( 'guide', 'fr_FR' ) ), str_replace( ABSPATH, 'ABSPATH/', (string) $r->get( 'guide', 'de_DE' ) ), $r->has( 'guide' ), $r->has( 'nothing' ) );
