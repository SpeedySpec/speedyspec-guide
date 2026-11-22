<?php
// A string translated in a context, through gettext_with_context and gettext_with_context_{domain}.
switch_to_locale( 'fr_FR' );
add_filter( 'gettext_with_context', fn( $t, $text, $context ) => "$t ($context)", 10, 3 );
add_filter( 'gettext_with_context_default', fn( $t ) => $t . '!' );
return array( translate_with_gettext_context( 'Post', 'verb' ), translate_with_gettext_context( 'Post', 'noun' ) );
