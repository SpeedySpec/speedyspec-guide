<?php
// Loads a .mo (or .l10n.php beside it) into a text domain for the locale, through pre_load_textdomain, override_load_textdomain, load_textdomain_mofile, translation_file_format and load_translation_file; it fires load_textdomain. A missing file gives false.
add_action( 'load_textdomain', fn( $domain, $file ) => print( "load_textdomain $domain " . basename( $file ) . "\n" ), 10, 2 );
add_filter( 'translation_file_format', function ( $format, $domain ) { echo "format $format for $domain\n"; return $format; }, 10, 2 );
$ok = load_textdomain( 'guide', WP_LANG_DIR . '/plugins/guide-fr_FR.mo', 'fr_FR' );
switch_to_locale( 'fr_FR' );
return array( $ok, __( 'Hello', 'guide' ), load_textdomain( 'nope', WP_LANG_DIR . '/missing.mo' ), is_textdomain_loaded( 'guide' ) );
