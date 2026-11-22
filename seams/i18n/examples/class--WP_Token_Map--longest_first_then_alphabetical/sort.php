<?php
// The sort the map uses: longer keys first, then alphabetical, so a key never matches inside a longer one.
$keys = array( 'Cap', 'CapitalDifferentialD', 'Ab', 'Abc' );
// It is private, so it is called through a closure bound to the class.
usort( $keys, Closure::bind( fn( $a, $b ) => self::longest_first_then_alphabetical( $a, $b ), null, WP_Token_Map::class ) );
return $keys;
