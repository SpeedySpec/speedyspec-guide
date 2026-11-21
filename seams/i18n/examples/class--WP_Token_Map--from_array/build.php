<?php
// Builds a map for fast lookups: keys longer than the key length (2) are grouped by their first two bytes, shorter ones go in a small-word table. to_array() gives the pairs back.
$smilies = WP_Token_Map::from_array( array( '8O' => '😯', ':(' => '🙁', ':)' => '🙂', ':?' => '😕', ':mrgreen:' => 'GREEN' ) );
return array( $smilies->to_array(), WP_Token_Map::from_array( array( 'x' => 'short' ) )->read_token( 'x!' ) );
