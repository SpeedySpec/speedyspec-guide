<?php
switch_to_locale( 'fr_FR' );
// Registers a plural with a context and domain, for translate_nooped_plural() later.
$noop = _nx_noop( '%d item', '%d items', 'count', 'guide' );
return array( $noop['context'], $noop['domain'], translate_nooped_plural( $noop, 2 ) );
