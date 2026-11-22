<?php
// _n() translates the plural form for a number, through ngettext and ngettext_{domain}; _nx() with a context, through ngettext_with_context.
$english = array( _n( '%d item', '%d items', 1 ), _n( '%d item', '%d items', 2 ) );
switch_to_locale( 'fr_FR' );
function guide_append_number( $translation, $single, $plural, $number ) {
	return "$translation/$number";
}
add_filter( 'ngettext', 'guide_append_number', 10, 4 );
function guide_append_context( $translation, $single, $plural, $number, $context ) {
	return "$translation@$context";
}
add_filter( 'ngettext_with_context', 'guide_append_context', 10, 5 );
return array( $english, _n( '%d item', '%d items', 0 ), _n( '%d item', '%d items', 2 ), _nx( '%d item', '%d items', 2, 'count' ) );
