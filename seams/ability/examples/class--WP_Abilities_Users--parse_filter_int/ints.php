<?php
// Reads a whole number at least the minimum from an int of any size, a digit string, or a whole float up to 2^53; anything else is null.
guide_core_abilities();
$users = new WP_Abilities_Users();
return array_map( fn( $v ) => guide_private( $users, 'parse_filter_int', $v, 1 ), array( 3, '7', 0, '-2', 4.0, 2.5, 'x', 2 ** 60 ) );
