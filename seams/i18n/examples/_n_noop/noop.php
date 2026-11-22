<?php
// _n_noop() and _nx_noop() register plural strings to translate later with translate_nooped_plural(), which needs a domain in the array or as an argument.
$noop = _n_noop( '%d item', '%d items' );
$noopx = _nx_noop( '%d item', '%d items', 'count', 'guide' );
switch_to_locale( 'fr_FR' );
return array( $noop, $noopx, translate_nooped_plural( $noop, 5 ), translate_nooped_plural( $noop, 1, 'default' ) );
