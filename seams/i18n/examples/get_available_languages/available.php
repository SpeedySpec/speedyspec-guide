<?php
// The locales with .mo files in a folder (WP_LANG_DIR by default), not counting continents-cities and admin files; get_available_languages filters them.
function guide_add_spanish( $languages, $dir ) {
	return array_merge( $languages, array( 'es_ES' ) );
}
add_filter( 'get_available_languages', 'guide_add_spanish', 10, 2 );
return array( get_available_languages(), get_available_languages( WP_LANG_DIR . '/plugins' ) );
