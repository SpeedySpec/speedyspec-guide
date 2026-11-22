<?php
// Loads a .mo (or .l10n.php beside it) into a text domain for the locale, through pre_load_textdomain, override_load_textdomain, load_textdomain_mofile, translation_file_format and load_translation_file; it fires load_textdomain. A missing file gives false.
function guide_print_loaded_textdomain( $domain, $file ) {
	echo "load_textdomain $domain " . basename( $file ) . "\n";
}
add_action( 'load_textdomain', 'guide_print_loaded_textdomain', 10, 2 );
function guide_print_file_format( $format, $domain ) {
	echo "format $format for $domain\n";
	return $format;
}
add_filter( 'translation_file_format', 'guide_print_file_format', 10, 2 );
$ok = load_textdomain( 'guide', WP_LANG_DIR . '/plugins/guide-fr_FR.mo', 'fr_FR' );
switch_to_locale( 'fr_FR' );
return array( $ok, __( 'Hello', 'guide' ), load_textdomain( 'nope', WP_LANG_DIR . '/missing.mo' ), is_textdomain_loaded( 'guide' ) );
