<?php
// _n() translates the plural form for a number, through ngettext and ngettext_{domain}; _nx() with a context, through ngettext_with_context.
$english = array( _n( '%d item', '%d items', 1 ), _n( '%d item', '%d items', 2 ) );
switch_to_locale( 'fr_FR' );
add_filter( 'ngettext', fn( $t, $s, $p, $n ) => "$t/$n", 10, 4 );
add_filter( 'ngettext_with_context', fn( $t, $s, $p, $n, $c ) => "$t@$c", 10, 5 );
return array( $english, _n( '%d item', '%d items', 0 ), _n( '%d item', '%d items', 2 ), _nx( '%d item', '%d items', 2, 'count' ) );
