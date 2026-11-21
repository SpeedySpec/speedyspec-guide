<?php
// Encodes a code point as UTF-8; an invalid one becomes the replacement character.
return array( WP_HTML_Decoder::code_point_to_utf8_bytes( 0x263A ), WP_HTML_Decoder::code_point_to_utf8_bytes( 0xD800 ) );
