<?php
// The site's locale: the $locale global once set, else WPLANG (or the network's), else en_US; locale filters it. Here the locale switcher's filter answers while switched.
$english = get_locale();
add_filter( 'locale', fn( $l ) => 'de_DE' === $l ? $l : $l, 20 );
switch_to_locale( 'fr_FR' );
return array( $english, get_locale(), $GLOBALS['locale'] );
