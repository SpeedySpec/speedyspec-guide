<?php
// Whether a word is a key, case-sensitively or not.
$smilies = WP_Token_Map::from_array( array( '8O' => '😯', ':(' => '🙁', ':)' => '🙂', ':?' => '😕', ':mrgreen:' => 'GREEN' ) );
return array( $smilies->contains( ':)' ), $smilies->contains( ':MRGREEN:', 'ascii-case-insensitive' ), $smilies->contains( ':MRGREEN:' ), $smilies->contains( 'simile' ) );
