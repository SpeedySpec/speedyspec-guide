<?php
// Whether a string has a translation in a text domain and locale.
switch_to_locale( 'fr_FR' );
__( 'Hello' );
// Only translations already loaded count.
return array( has_translation( 'Hello', 'default', 'fr_FR' ), has_translation( 'Goodbye', 'default', 'fr_FR' ), has_translation( 'Hello' ) );
