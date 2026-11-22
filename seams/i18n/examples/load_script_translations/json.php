<?php
// A script's translations from its JSON file, through pre_load_script_translations, load_script_translation_file and load_script_translations; a missing file gives false.
$file = WP_LANG_DIR . '/guide-fr_FR-handle.json';
file_put_contents( $file, '{"locale_data":{"messages":{"Hello":["Bonjour"]}}}' );
function guide_print_translation_file( $file, $handle, $domain ) {
	echo "file for $handle in $domain\n";
	return $file;
}
add_filter( 'load_script_translation_file', 'guide_print_translation_file', 10, 3 );
$json = load_script_translations( $file, 'handle', 'guide' );
function guide_early_translations( $translations, $file, $handle ) {
	return 'early' === $handle ? '{}' : $translations;
}
add_filter( 'pre_load_script_translations', 'guide_early_translations', 10, 3 );
$early = load_script_translations( '/nowhere.json', 'early', 'guide' );
unlink( $file );
return array( $json, $early, load_script_translations( '/nowhere.json', 'x', 'guide' ) );
