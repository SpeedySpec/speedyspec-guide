<?php
// The pure-PHP engine: a longest-common-subsequence diff of two lists of lines.
require_once ABSPATH . 'wp-includes/Text/Diff/Engine/native.php';
$edits = ( new Text_Diff_Engine_native() )->diff( array( 'a', 'b' ), array( 'b' ) );
return array_map( 'get_class', $edits );
