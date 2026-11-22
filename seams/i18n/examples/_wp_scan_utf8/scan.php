<?php
// Scans code points from a byte offset until an invalid span, returning how many it found and setting where it stopped and the invalid span's length.
$at = 0;
$invalid = 0;
$count = _wp_scan_utf8( "ab\xC3\xA9\xFFcd", $at, $invalid );
$first = array( $count, $at, $invalid );
$at += $invalid;
$count = _wp_scan_utf8( "ab\xC3\xA9\xFFcd", $at, $invalid );
return array( $first, array( $count, $at, $invalid ) );
