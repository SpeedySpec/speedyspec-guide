<?php
// poify() quotes and escapes a string for PO, splitting at newlines; unpoify() gives it back; prepend_each_line() and comment_block() prefix lines.
$poified = PO::poify( "Line \"one\"\nLine\ttwo" );
return array( $poified, PO::unpoify( $poified ), PO::prepend_each_line( "a\nb", '# ' ), PO::comment_block( 'A note', ':' ), PO::trim_quotes( '"x"' ) );
