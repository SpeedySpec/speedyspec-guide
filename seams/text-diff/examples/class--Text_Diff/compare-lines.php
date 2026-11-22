<?php
// Compares two lists of lines; the result is a list of edits: copies, deletions, additions and changes.
$diff = new Text_Diff( 'native', array( array( 'a', 'b', 'c' ), array( 'a', 'B', 'c', 'd' ) ) );
return array_map( 'get_class', $diff->getDiff() );
