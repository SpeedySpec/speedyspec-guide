<?php
switch_to_locale( 'fr_FR' );
// Translates a plural registered with _n_noop(); without a domain in it, the domain argument (default by default).
$noop = _n_noop( '%d item', '%d items' );
return array( translate_nooped_plural( $noop, 1 ), translate_nooped_plural( $noop, 3 ), translate_nooped_plural( $noop, 3, 'none' ) );
