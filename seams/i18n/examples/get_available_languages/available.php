<?php
// The locales with .mo files in a folder (WP_LANG_DIR by default), not counting continents-cities and admin files; get_available_languages filters them.
add_filter( 'get_available_languages', fn( $langs, $dir ) => array_merge( $langs, array( 'es_ES' ) ), 10, 2 );
return array( get_available_languages(), get_available_languages( WP_LANG_DIR . '/plugins' ) );
