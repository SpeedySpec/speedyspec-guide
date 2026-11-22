<?php
// The font-family CSS for the site's language and a context (front-end, block-editor, classic-editor), for languages that need other fonts; empty otherwise. Both lists are filtered.
guide_theme( 'twentytwentyone' );
$english = twenty_twenty_one_get_non_latin_css();
function guide_hebrew_locale( $locale ) {
	return 'he_IL';
}
add_filter( 'locale', 'guide_hebrew_locale' );
return array( $english, substr( twenty_twenty_one_get_non_latin_css( 'front-end' ), -60 ) );
