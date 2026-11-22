<?php
// A string translated in a context, through gettext_with_context and gettext_with_context_{domain}.
switch_to_locale( 'fr_FR' );
function guide_append_gettext_context( $translation, $text, $context ) {
	return "$translation ($context)";
}
add_filter( 'gettext_with_context', 'guide_append_gettext_context', 10, 3 );
function guide_exclaim_translation( $translation ) {
	return $translation . '!';
}
add_filter( 'gettext_with_context_default', 'guide_exclaim_translation' );
return array( translate_with_gettext_context( 'Post', 'verb' ), translate_with_gettext_context( 'Post', 'noun' ) );
