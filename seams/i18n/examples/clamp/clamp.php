<?php
// PHP 8.6's clamp(), polyfilled before: the value limited to min and max; NAN bounds or max under min throw a ValueError.
$results = array( clamp( 5, 1, 3 ), clamp( -2, 0, 10 ), clamp( 2.5, 1, 3 ) );
try { clamp( 1, 5, 2 ); } catch ( ValueError $e ) { $results[] = $e->getMessage(); }
return $results;
