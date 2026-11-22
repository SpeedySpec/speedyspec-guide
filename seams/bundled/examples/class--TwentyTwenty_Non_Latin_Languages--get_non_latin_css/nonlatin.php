<?php
// The font-family CSS for the site's language and a context (front-end, block-editor, classic-editor), for languages that need other fonts; nothing otherwise. Both lists are filtered.
guide_theme( 'twentytwenty' );
$english = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' );
function guide_hebrew_locale( $locale ) {
	return 'he_IL';
}
add_filter( 'locale', 'guide_hebrew_locale' );
return array( $english, substr( TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' ), -60 ) );
