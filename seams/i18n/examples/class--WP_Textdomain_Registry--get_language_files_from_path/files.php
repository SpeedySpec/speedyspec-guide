<?php
// The .mo and .l10n.php files in a folder, cached; pre_get_language_files_from_path can answer instead; invalidate_mo_files_cache() empties the cache after updates.
$r = $GLOBALS['wp_textdomain_registry'];
$files = array_map( 'basename', $r->get_language_files_from_path( WP_LANG_DIR . '/plugins' ) );
add_filter( 'pre_get_language_files_from_path', fn( $files, $path ) => array( $path . 'x.mo' ), 10, 2 );
return array( $files, array_map( 'basename', $r->get_language_files_from_path( WP_LANG_DIR ) ) );
