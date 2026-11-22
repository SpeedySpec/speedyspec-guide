<?php
// The value of the longest key at an offset, and its byte length, or false; read_small_token() handles keys no longer than the key length.
$smilies = WP_Token_Map::from_array( array( '8O' => '😯', ':(' => '🙁', ':)' => '🙂', ':?' => '😕', ':mrgreen:' => 'GREEN' ) );
$length = 0;
$found = $smilies->read_token( 'Not sure :?.', 9, $length );
return array( $found, $length, $smilies->read_token( 'Not sure :?.', 0 ), $smilies->read_token( 'x :mrgreen: y', 2, $length ), $length );
