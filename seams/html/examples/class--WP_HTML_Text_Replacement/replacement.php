<?php
// A pending change: replace length bytes at start with text.
$r = new WP_HTML_Text_Replacement( 1, 2, 'xy' );
return array( $r->start, $r->length, $r->text );
