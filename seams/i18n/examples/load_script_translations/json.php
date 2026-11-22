<?php
// A script's translations from its JSON file, through pre_load_script_translations, load_script_translation_file and load_script_translations; a missing file gives false.
$file = WP_LANG_DIR . '/guide-fr_FR-handle.json';
file_put_contents( $file, '{"locale_data":{"messages":{"Hello":["Bonjour"]}}}' );
add_filter( 'load_script_translation_file', function ( $f, $handle, $domain ) { echo "file for $handle in $domain\n"; return $f; }, 10, 3 );
$json = load_script_translations( $file, 'handle', 'guide' );
add_filter( 'pre_load_script_translations', fn( $t, $f, $handle ) => 'early' === $handle ? '{}' : $t, 10, 3 );
$early = load_script_translations( '/nowhere.json', 'early', 'guide' );
unlink( $file );
return array( $json, $early, load_script_translations( '/nowhere.json', 'x', 'guide' ) );
