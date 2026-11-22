<?php
// A match reference: $N, or $matches[N] when the matches property is set.
$r = $GLOBALS['wp_rewrite'];
$plain = $r->preg_index( 2 );
$r->matches = 'matches';
return array( $plain, $r->preg_index( 2 ) );
