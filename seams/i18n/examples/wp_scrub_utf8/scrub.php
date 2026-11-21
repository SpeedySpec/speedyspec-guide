<?php
// Replaces each maximal invalid span with U+FFFD; _wp_scrub_utf8_fallback() does the same without mbstring.
$text = "Pi\xF1a \xE2\x80 ok";
return array( wp_scrub_utf8( $text ), _wp_scrub_utf8_fallback( $text ), wp_scrub_utf8( 'fine' ) );
