<?php
// Removes line-ending characters from a line; engines call it on every line through array_walk().
$lines = array( "a\n", "b\r\n" );
array_walk( $lines, array( 'Text_Diff', 'trimNewlines' ) );
return $lines;
