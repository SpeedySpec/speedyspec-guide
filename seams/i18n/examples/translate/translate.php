<?php
// A string translated in a text domain, through gettext and gettext_{domain}; with nothing loaded, the original.
$english = translate( 'Hello' );
switch_to_locale( 'fr_FR' );
add_filter( 'gettext', fn( $t, $text, $domain ) => "[$t]", 10, 3 );
add_filter( 'gettext_default', fn( $t ) => strtoupper( $t ) );
return array( $english, translate( 'Hello' ), translate( 'Unknown' ) );
