<?php
// The site's locale: the $locale global once set, else WPLANG (or the network's), else en_US; locale filters it. Here the locale switcher's filter answers while switched.
$english = get_locale();
function guide_filter_locale( $locale ) {
	return 'de_DE' === $locale ? $locale : $locale;
}
add_filter( 'locale', 'guide_filter_locale', 20 );
switch_to_locale( 'fr_FR' );
return array( $english, get_locale(), $GLOBALS['locale'] );
