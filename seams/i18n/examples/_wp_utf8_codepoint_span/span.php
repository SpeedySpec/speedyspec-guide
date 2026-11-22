<?php
// How many bytes a number of code points from an offset take, reporting how many it found.
$found = 0;
$bytes = _wp_utf8_codepoint_span( 'aé🙂z', 0, 3, $found );
return array( $bytes, $found, _wp_utf8_codepoint_span( 'ab', 0, 5 ) );
