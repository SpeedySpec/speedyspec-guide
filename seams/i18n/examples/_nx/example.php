<?php
switch_to_locale( 'fr_FR' );
// The plural translation for a number in a context; with no entry in that context, the English plural rules.
return array( _nx( '%d item', '%d items', 2, 'count' ), _nx( '%d item', '%d items', 1, 'count' ) );
