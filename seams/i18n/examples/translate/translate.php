<?php
// A string translated in a text domain, through gettext and gettext_{domain}; with nothing loaded, the original.
$english = translate( 'Hello' );
switch_to_locale( 'fr_FR' );
function guide_bracket_translation( $translation, $text, $domain ) {
	return "[$translation]";
}
add_filter( 'gettext', 'guide_bracket_translation', 10, 3 );
function guide_uppercase_translation( $translation ) {
	return strtoupper( $translation );
}
add_filter( 'gettext_default', 'guide_uppercase_translation' );
return array( $english, translate( 'Hello' ), translate( 'Unknown' ) );
