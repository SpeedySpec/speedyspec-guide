<?php
// The .mo and .l10n.php files in a folder, cached; pre_get_language_files_from_path can answer instead; invalidate_mo_files_cache() empties the cache after updates.
$r = $GLOBALS['wp_textdomain_registry'];
$files = array_map( 'basename', $r->get_language_files_from_path( WP_LANG_DIR . '/plugins' ) );
function guide_pre_language_files( $files, $path ) {
	return array( $path . 'x.mo' );
}
add_filter( 'pre_get_language_files_from_path', 'guide_pre_language_files', 10, 2 );
return array( $files, array_map( 'basename', $r->get_language_files_from_path( WP_LANG_DIR ) ) );
