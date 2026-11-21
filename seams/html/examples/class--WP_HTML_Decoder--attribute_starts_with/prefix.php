<?php
// Checks a raw attribute value's start without decoding all of it.
return array( WP_HTML_Decoder::attribute_starts_with( '&#x6A;avascript:alert(1)', 'javascript:', 'ascii-case-insensitive' ), WP_HTML_Decoder::attribute_starts_with( 'https://x', 'javascript:' ) );
